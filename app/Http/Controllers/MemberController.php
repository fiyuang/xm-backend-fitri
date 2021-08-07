<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tag;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use File;

class MemberController extends Controller
{
    public function guru() //Index of HR
    {
        $hrs = User::GuruOnly()->orderBy('id', 'DESC')->get();
        $tags = Tag::get();
        return view('admin.hr.index', [
            'hrs' => $hrs,
            'tags' => $tags
        ]);
    }

    public function detailGuruJson($id)
    {
        $data = User::with('profile','cv','trx_tag')->where('id', $id)->first();
        return response()->json($data);
    }

    public function detail($id)
    {
        $data = User::with('profile','cv','trx_tag')->where('id', $id)->first();
        // return $data;
        return view('admin.hr.detail', [
            'data' => $data
        ]);
    }

    public function update_status(Request $request)
    {
        $user = User::where('id', $request->id)->first();

        \DB::beginTransaction();
        try {
            
            $result = $user->update([
                'status' => $request->status
            ]);

            if ($result) {
                \DB::commit();
                return response()->json([
                    'message' => "Data berhasil diubah",
                    'success'=> true
                ]);
            } else {
                \DB::rollback();
                return response()->json([
                    'message' => $e->getMessage(),
                    'success'=> false
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

    public function create_hr(Request $request)
    {
        $validator = \Validator::make($request->all(), 
            [
              'profile_picture' => 'required|mimes:jpeg,jpg,png|max:5120',
              'cv' => 'required|mimes:pdf|max:5120',
            ], [
              'profile_picture.mimes' => 'Format file profile picture tidak sesuai',
              'profile_picture.max' => 'Ukuran file maksimal 5 Mb',
              'cv.mimes' => 'Format file CV tidak sesuai',
              'cv.max' => 'Ukuran file maksimal 5 Mb',
            ]
        );
        
        if ($validator->fails())
        {
            return response()->json([
                'errors'=>$validator->errors()->all()
            ]);
        }

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

            // Upload CV Document
            if($request->hasFile('cv')){
                $cv = $this->uploadCV($request->file('cv'), 1);
                $checkCurrentCV = ['documentable_id' => $user->id, 'documentable_type' => 'App\User', 'type' => 1];
                $user->uploadOrReplaceDocument($checkCurrentCV, $cv['file_name'], $cv['file_path'], 1);
            }     
  
            \DB::commit();

            if($user){
                return response()->json([
                    'data' => $user,
                    'success'=> 'Data berhasil disimpan'
                ]);
            }

        } catch (\Exception $e){
            \DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'success'=> 'Error'
            ]);
        }
    }

    public function uploadCV($data, $type)
    {
        $filename = 'cv' . '-' . time() . '.' . $data->getClientOriginalExtension();
        $path = public_path('documents/HR/CV');
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
            }
        $filepath = 'documents/HR/CV/'.$filename;
        $save = $data->move($path, $filename);

        return [
            'file_name' => $filename,
            'file_path' => $filepath
        ];
    }

    public function delete_hr($id)
    {
        User::where('id', $id)->forceDelete();
        Alert::toast('Data berhasil dihapus', 'success')->padding('10px')->timerProgressBar();
        return redirect()->back();
    }
}
