<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showFormLogin()
    {
        if (Auth::check()) { //true & session field di users dapat dipanggil via Auth
            //Login Success
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }
  
    public function login(Request $request)
    {
        $rules = [
            'email'                  => 'required',
            'password'              => 'required|string'
        ];
  
        $messages = [
            'email.required'        => 'Email wajib diisi',
            'password.required'     => 'Password wajib diisi',
            'password.string'       => 'Password harus berupa string'
        ];
  
        $validator = Validator::make($request->all(), $rules, $messages);
  
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
  
        $data = [
            'email'      => $request->input('email'),
            'password'  => $request->input('password'),
        ];

        $user = \App\User::where('email', $request->email)->first();

        // if(isset($user) && $user->user_type != 1) { //user type selain admin tidak bisa login
        //     return redirect()->back()->with('error', 'Maaf, anda tidak memiliki akses masuk!');
        // } else {
            Auth::attempt($data);
  
            if (Auth::check()) {
                //Login Success
                return redirect()->route('home');
            } else {
                //Login Fail
                Session::flash('error', 'Email atau password salah');
                return redirect()->route('login');
            }
        // }
  
    }

    public function logout()
    {
        Auth::logout(); // menghapus session yang aktif
        return redirect()->route('login');
    }
}
