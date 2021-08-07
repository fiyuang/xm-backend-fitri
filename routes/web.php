<?php

use Illuminate\Support\Facades\Route;

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

Route::prefix('admin')->group(function() {
    // No Need Auth
    Route::get('/login', 'Auth\LoginController@showFormLogin')->name('login');

    // Need Auth
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/','DashboardController@index')->name('dashboard');
        // Route::get('/home', 'HomeController@index')->name('home');

        Route::prefix('members')->group(function() {
            Route::get('/guru','MemberController@guru')->name('dashboard.guru');
            Route::post('/store/guru','MemberController@create_guru')->name('guru.store');
            Route::post('/delete/guru/{id}','MemberController@delete_guru')->name('guru.destroy');
            Route::get('/guru/{id}/json','MemberController@detailGuruJson');
            Route::get('/{id}/guru','MemberController@detail')->name('guru.detail');
            Route::post('/guru/update','MemberController@update_status')->name('guru.update');
    
            Route::get('/jobseeker','MemberController@jobseekers')->name('dashboard.jobseeker');
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

    Route::get('/guru-list','HRController@index')->name('frontend.guru-list');

    Route::get('/complete-profile', 'ProfileController@index')->name('complete.profile');
    Route::post('/complete-profile', 'ProfileController@store')->name('complete.profile.store');
});

