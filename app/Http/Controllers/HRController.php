<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Schedule;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use File;

class HRController extends Controller
{
    public function index() //Index of HR
    {
        $hrs = User::with('profile')->GuruOnly()->orderBy('id', 'DESC')->where('status', 3)->get();
        // $industries = Industry::get();
        // return $hrs;
        return view('frontend.guru-list', [
            'hrs' => $hrs,
        ]);
    }

    public function create_schedule(Request $request)
    {
        $validator = \Validator::make($request->all(), 
            [
              'schedule_date' => 'required',
              'schedule_time' => 'required',
            ], [
              'schedule_date.required' => 'Tanggal Perlu Diisi',
              'schedule_time.required' => 'Jam Perlu Diisi',
            ]
        );
        
        if ($validator->fails())
        {
            return response()->json([
                'errors'=>$validator->errors()->all()
            ]);
        }

        $schedule = Schedule::where('guru_id', $request->guru_id)->where('date', $request->schedule_date)->where('time', $request->schedule_time)->first();
        if(isset($schedule)){
            return response()->json([
                'success' => false,
                'message' => "Jadwal dengan Guru pada Waktu & Jam tersebut telah terisi, silahkan pilih ulang jadwal Anda",
            ]);
        } else {
            \DB::beginTransaction();
            try {

                $create_schedule = Schedule::create([
                    'talent_id' => \Auth::user()->id,
                    'guru_id' => $request->guru_id,
                    'date' => $request->schedule_date,
                    'time' => $request->schedule_time,
                    'notes' => $request->notes,
                    'is_approved' => 1
                ]);
    
                \DB::commit();

                if($create_schedule){
                    return response()->json([
                        'message' => 'Jadwal berhasil disimpan',
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

}
