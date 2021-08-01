<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Industry;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use File;

class HRController extends Controller
{
    public function index() //Index of HR
    {
        $hrs = User::with('profile', 'trx_industry')->HrOnly()->orderBy('id', 'DESC')->get();
        $industries = Industry::get();
        // return $hrs;
        return view('frontend.hr-list', [
            'hrs' => $hrs,
            'industries' => $industries
        ]);
    }

}
