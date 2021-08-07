<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use File;

class HRController extends Controller
{
    public function index() //Index of HR
    {
        $hrs = User::with('profile')->GuruOnly()->orderBy('id', 'DESC')->get();
        // $industries = Industry::get();
        // return $hrs;
        return view('frontend.guru-list', [
            'hrs' => $hrs,
        ]);
    }

}
