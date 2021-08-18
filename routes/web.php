<?php

use Illuminate\Support\Facades\Route;
use Spatie\GoogleCalendar\Event;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', function(){
    return Carbon\Carbon::now();

});

Route::prefix('admin')->group(function() {
    // No Need Auth
    Route::get('/login', 'Auth\LoginController@showFormLogin')->name('admin.login');

    // Need Auth
    Route::group(['middleware' => ['role:Admin'], 'auth'], function () {
        Route::get('/','DashboardController@index')->name('dashboard');
        // Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/{id}/schedule','DashboardController@detail')->name('schedule.detail');

        Route::prefix('members')->group(function() {
            Route::get('/guru','MemberController@guru')->name('dashboard.guru');
            Route::post('/store/guru','MemberController@create_guru')->name('guru.store');
            Route::get('/guru/{id}/json','MemberController@detailGuruJson');
            Route::get('/{id}/guru','MemberController@detail_guru')->name('guru.detail');
            Route::post('/guru/update','MemberController@update_status')->name('guru.update');
    
            Route::get('/user','MemberController@user')->name('dashboard.user');
            Route::get('/{id}/user','MemberController@detail_user')->name('user.detail');
            Route::post('/delete/{id}','MemberController@delete')->name('user.destroy');
        });
    });  
});

// Group No Need Auth
Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/login', function () {
    return view('login');
});
Route::post('/register', 'Auth\RegisterController@register')->name('register');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');

// Group Need Auth
Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('/complete-profile', 'ProfileController@index')->name('complete.profile');
    Route::post('/complete-profile', 'ProfileController@store')->name('complete.profile.store');
    Route::get('/detail-profile', 'ProfileController@detail')->name('detail.profile');
    Route::get('/schedule/{id}/json','GuruController@scheduleJson');
    Route::post('/update-schedule','GuruController@update_schedule')->name('frontend.update.schedule');
    Route::get('/schedule/{id}/log-activity', 'GuruController@scheduleActivityLog')->name('schedule.activitiLog');

    Route::group(['middleware' => ['role:Talent']], function () {
        Route::get('/guru-list','TalentController@index')->name('frontend.guru-list');
        Route::post('/create-schedule','TalentController@create_schedule')->name('frontend.create.schedule');
        Route::get('/user/schedule-list','TalentController@list_schedule')->name('frontend.user.schedule-list');
    });

    Route::group(['middleware' => ['role:Guru']], function () {
        Route::get('/guru/schedule-list','GuruController@index')->name('frontend.guru.schedule-list');
    });

});

