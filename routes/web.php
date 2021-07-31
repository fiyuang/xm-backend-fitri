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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', 'Auth\LoginController@showFormLogin')->name('login');
Route::post('login', 'Auth\LoginController@login');

Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/admin','DashboardController@index')->name('dashboard');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    Route::prefix('members')->group(function() {
        Route::get('/hr','MemberController@hr')->name('dashboard.hr');
        Route::post('/store/hr','MemberController@create_hr')->name('hr.store');
        Route::post('/delete/hr/{id}','MemberController@delete_hr')->name('hr.destroy');
    });
 
});