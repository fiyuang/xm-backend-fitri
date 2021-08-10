<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Schedule;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use File;

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

        \DB::beginTransaction();
            try {

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
}