<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Industry;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use File;

class MemberController extends Controller
{
    public function hr() //Index of HR
    {
        $hrs = User::HrOnly()->orderBy('id', 'DESC')->get();
        $industries = Industry::get();
        return view('admin.hr.index', [
            'hrs' => $hrs,
            'industries' => $industries
        ]);
    }

    public function jobseekers() //Index of Jobseekers
    {
        $jobseekers = User::jobseekerOnly()->orderBy('id', 'DESC')->get();
        return view('admin.jobseeker.index', [
            'jobseekers' => $jobseekers
        ]);
    }

    public function create_hr(Request $request)
    {
        \DB::beginTransaction();
        try {

            // upload profile picture
            if($request->hasFile('profile_picture')){
                $image   = $request->file('profile_picture');
                $filename = 'profile_picture' . '-' . time() . '.' . $image->getClientOriginalExtension();
                $path = public_path('documents/HR/profile');
                    if(!File::isDirectory($path)){
                        File::makeDirectory($path, 0777, true, true);
                    }
                $filepath = 'documents/HR/profile';
                $save = $image->move($path, $filename);
            }

            $user = User::create([
                'name' => $request->name,
                'user_type' => 2,
                'email' => $request->email,
                'password' => Hash::make(12345678),
            ]);

            $user->profile()->create([
                'gender' => $request->gender,
                'mobile_number' => $request->mobile_number,
                'date_of_birth' => $request->dob,
                'education' => $request->education,
                'profile_picture' => "$filepath/$filename"
            ]);

            // save industries of user
            for($i = 0; $i < count($request->industries); $i++){
                $user->trx_industry()->create([
                    'industry_id' => $request->industries[$i]
                ]);
            }
  
            \DB::commit();

            if($user){
                Alert::toast('Data berhasil disimpan', 'success')->padding('10px')->timerProgressBar();
            }

        } catch (\Exception $e){
            \DB::rollback();
            Alert::toast($e->getMessage(), 'error')->padding('10px')->timerProgressBar();
        }

        return redirect()->back();

    }

    public function delete_hr($id)
    {
        User::where('id', $id)->forceDelete();
        Alert::toast('Data berhasil dihapus', 'success')->padding('10px')->timerProgressBar();
        return redirect()->back();
    }
}
