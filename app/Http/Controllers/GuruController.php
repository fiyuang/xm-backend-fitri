<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Schedule;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use File;
use App\Jobs\BookEmailJob;
use Spatie\GoogleCalendar\Event;
use DateTime;
use Carbon\Carbon;
use DataTables;

class GuruController extends Controller
{
    public function index() //Index of Guru's Schedule
    {
        $schedules = Schedule::where('guru_id', \Auth::user()->id)->orderBy('id', 'DESC')->get();
        // return $schedules;
        return view('frontend.guru.schedule-list', [
            'schedules' => $schedules,
        ]);
    }

    public function scheduleJson($id) //Detail of Schedule
    {
        $data = Schedule::with(['talent' => function($query) {
            $query->select('id','name','email');
        }, 'talent.cv', 'talent.profile' => function($query){
            $query->select('id', 'user_id', 'mobile_number');
        }, 'guru' => function($query) {
            $query->select('id','name','email');
        }])->where('id', $id)->first();
        return response()->json($data);
    }

    public function update_schedule(Request $request)
    {

        $schedule = Schedule::where('id', $request->schedule_id)->first();
        $user = User::where('id', $schedule->talent_id)->first();
        $guru = User::where('id', $schedule->guru_id)->first();
        $status_before = $schedule->is_approved;

        \DB::beginTransaction();
            try {

                if($request->is_approved == 2 || $request->is_approved == 3){

                    // Add activity log
                    activity('guru-status')
                    ->performedOn($schedule)
                    ->withProperties(
                        [
                            'after'  => ['status' => $request->is_approved],
                            'before' => ['status' => $status_before],
                            'reason' => $request->approved_reason
                        ]
                    )
                    ->log('Update Status');
                    
                     // Details for email variable
                    $date_format = Carbon::parse($schedule->date);
                    $date = $date_format->format('d F Y');

                    $details['type'] = 'ScheduleApproved';
                    $details['user_email'] = $user->email;
                    $details['user_name'] = $user->name;
                    $details['guru_name'] = $guru->name;
                    $details['schedule_date'] = $date;
                    $details['schedule_time'] = $schedule->time;
                    $details['is_approved'] = $request->is_approved;
                    $details['approved_reason'] = $request->approved_reason ? $request->approved_reason : '-';
                    dispatch(new BookEmailJob($details));

                } else if ($request->is_approved == 4) {

                    // Add activity log
                    activity('user-status')
                    ->performedOn($schedule)
                    ->withProperties(
                        [
                            'after'  => ['status' => $request->is_approved],
                            'before' => ['status' => $status_before],
                        ]
                    )
                    ->log('Update Status');

                    //create a new event
                    $event = new Event;
                    $date = ($schedule->date)->format('Y-m-d');
                    $event->name = "Schedule with " . $user->name . " and " . $guru->name;
                    $event->startDateTime = Carbon::parse($date . ' '. $schedule->time, 'Asia/Jakarta');
                    $event->endDateTime = Carbon::parse($date . ' '. $schedule->time, 'Asia/Jakarta')->addMinute(30);
                    $event->save();

                } else {

                    // Add activity log
                    activity('user-status')
                    ->performedOn($schedule)
                    ->withProperties(
                        [
                            'after'  => ['status' => $request->is_approved],
                            'before' => ['status' => $status_before],
                        ]
                    )
                    ->log('Update Status');
                }

                $update_schedule = $schedule->update([
                    'is_approved' => $request->is_approved,
                    'approved_reason' => $request->approved_reason
                ]);

                \DB::commit();

                if($update_schedule){
                    return response()->json([
                        'message' => 'Jadwal berhasil diupdate',
                        'success'=> true
                    ]);
                }

            } catch (\Exception $e){
                \DB::rollback();
                return response()->json([
                    'message' => $e->getMessage(),
                    'success'=> false
                ]);
            }
        
    }

    public function scheduleActivityLog($id)
    {
        $schedule = Schedule::find($id);

        $activities = $schedule->activities->load('causer');

        return DataTables::of($activities)
            ->addIndexColumn()
            ->addColumn('status_before', function($row) {
                return isset($row->properties['before']) ? $this->getStylingByStatus($row->properties['before']['status']) : '';
            })
            ->addColumn('status_after', function($row) {
                return isset($row->properties['before']) ? $this->getStylingByStatus($row->properties['after']['status']) : '';
            })
            ->addColumn('reason', function($row) {
                return  isset($row->properties['reason']) ? $row->properties['reason'] : '';
            })
            ->addColumn('created_at', function($row) {
                return $row->created_at->format('d M Y - H:i:s');
            })
            ->rawColumns(['status_before','status_after','reason','created_at','action'])
            ->make(true);  
    }

    public function getStylingByStatus($status)
    {
        switch ($status) {
            case '1':
                return '<span class="badge-sm badge-pill badge-warning">Waiting</span>';
                break;

            case '2':
                return '<span class="badge-sm badge-pill badge-success">Approved</span>';
                break;

            case '3':
                return '<span class="badge-sm badge-pill badge-danger">Not Approved</span>';
                break;

            case '4':
                return '<span class="badge-sm badge-pill badge-primary">Save</span>';
                break;

            case '5':
                return '<span class="badge-sm badge-pill badge-danger">Decline</span>';
                break;
        }
    }
}