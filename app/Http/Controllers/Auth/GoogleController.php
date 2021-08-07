<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use Socialite;
use Auth;
use Exception;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
  
class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
      
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
    
            $user = Socialite::driver('google')->user();
     
            $finduser = User::where('google_id', $user->id)->first();
     
            if($finduser){
     
                Auth::login($finduser);

                if ($finduser->status == 2 || $finduser->status == 3){
                    return redirect('/guru-list');
                } else {
                    return redirect('/complete-profile');
                }    
     
            }else{
                $newUser = User::updateOrCreate(['email' => $user->email,],[
                    'name' => $user->name,             
                    'google_id'=> $user->id,
                    'status' => 1, //Baru
                    'password' => Hash::make('12345678')
                ]);
    
                Auth::login($newUser);
     
                return redirect('/complete-profile');
            }
    
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}