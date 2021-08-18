<?php

namespace App\Http\Controllers;

use App\Helpers;
use Illuminate\Http\Request;
use App\User;
use App\Schedule;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::orderBy('id', 'DESC')->get();
        // dd($schedules);
        return view('admin.dashboard.index', [
            'schedules' => $schedules
        ]);
    }

    public function detail($id)
    {
        $data = Schedule::with('guru', 'talent')->where('id', $id)->first();
        $activities = $data->activities->load('causer');
        // return $activities;
        return view('admin.dashboard.detail', [
            'data' => $data,
            'activities' => $activities
        ]);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
