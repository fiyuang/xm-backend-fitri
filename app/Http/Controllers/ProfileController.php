<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tag;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use File;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::where('id', \Auth::user()->id)->first();
        $tags = Tag::get();
        return view('frontend.register', [
            'user' => $user,
            'tags' => $tags
        ]);
    }

    public function detail()
    {
        $data = User::with('profile','cv','trx_tag')->where('id', \Auth::user()->id)->first();
        return view('frontend.profile', [
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), 
            [
              'user_type' => 'required',
              'name' => 'required',
              'mobile_number' => 'required',
              'dob' => 'required',
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
            return redirect()->back()->withErrors($validator)->withInput($request->all());

        }

        $user_id = \Auth::user()->id;

        \DB::beginTransaction();
        try {

            // upload profile picture
            if($request->hasFile('profile_picture')){
                $image   = $request->file('profile_picture');
                $filename = 'profile_picture' . '-' . time() . '.' . $image->getClientOriginalExtension();
                $path = public_path('documents/profile');
                    if(!File::isDirectory($path)){
                        File::makeDirectory($path, 0777, true, true);
                    }
                $filepath = 'documents/profile';
                $save = $image->move($path, $filename);
            }

            $user = User::updateOrcreate(['id' => $user_id],[
                'name' => $request->name,
                'user_type' => $request->user_type,
                'status' => 2, //Menunggu direview
            ]);

            $user->profile()->updateOrCreate(['user_id' => $user_id],[
                'mobile_number' => $request->mobile_number,
                'date_of_birth' => $request->dob,
                'profile_picture' => "$filepath/$filename"
            ]);

            // save tags of guru
            if($request->tags){
                for($i = 0; $i < count($request->tags); $i++){
                    $user->trx_tag()->updateOrCreate([
                        'tag_id' => $request->tags[$i]
                    ]);
                }
            }

            if($request->user_type == 2){
                $user->roles()->sync(2);
            } else if ($request->user_type == 3){
                $user->roles()->sync(3);
            }
            
            // Upload CV Document
            if($request->hasFile('cv')){
                $cv = $this->uploadCV($request->file('cv'), 1);
                $checkCurrentCV = ['documentable_id' => $user->id, 'documentable_type' => 'App\User', 'type' => 1];
                $user->uploadOrReplaceDocument($checkCurrentCV, $cv['file_name'], $cv['file_path'], 1);
            }     
  
            \DB::commit();

            if($user){
                // return response()->json([
                //     'data' => $user,
                //     'success'=> 'Data berhasil disimpan'
                // ]);
                Alert::toast('Data berhasil disimpan', 'success')->padding('10px');
                return redirect()->route('detail.profile');
            }

        } catch (\Exception $e){
            \DB::rollback();
            // return response()->json([
            //     'message' => $e->getMessage(),
            //     'success'=> 'Error'
            // ]);
            Alert::toast('Terjadi kesalahan', 'error')->padding('10px');
            return redirect()->back();
        }
    }

    public function uploadCV($data, $type)
    {
        $filename = 'cv' . '-' . time() . '.' . $data->getClientOriginalExtension();
        $path = public_path('documents/CV');
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
            }
        $filepath = 'documents/CV/'.$filename;
        $save = $data->move($path, $filename);

        return [
            'file_name' => $filename,
            'file_path' => $filepath
        ];
    }
}
