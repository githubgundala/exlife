<?php

use Illuminate\Support\Facades\Redirect;
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
    return Redirect()->to('/login');
});
Auth::routes();
Route::get('logoutall', 'Auth\LoginController@logoutall');
Route::post('checkemail', 'Auth\RegisterController@checkemail');
Route::post('checkemailmember', 'MemberController@checkemail');
Route::post('checkusername', 'MemberController@checkusername');
Route::middleware('admin')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('home', 'AdminController@home');
        // crud admin
        Route::get('admin', 'AdminController@admin');
        Route::post('create', 'Auth\RegisterController@createAdmin');
        Route::post('delete', 'AdminController@deleteAdmin');
        Route::post('update', 'AdminController@updateAdmin');
        // crud member
        Route::get('member', 'MemberController@member');
        Route::post('member/create', 'MemberController@createMember');
        Route::post('member/update', 'MemberController@updateMember');
        Route::post('member/delete', 'MemberController@deleteMember');
        Route::get('profile', function () {
            return view('admin.profile');
        });
        Route::get('member/info/{userid}', 'MemberController@memberInfo');
        Route::get('upload/form', 'AdminController@uploadForm');
        Route::get('upload/delete/{id}', 'AdminController@uploadDelete');
        Route::post('upload/store', 'AdminController@upload')->name('upload');
        
    });
});
Route::middleware('auth')->group(function () {
    Route::prefix('member')->group(function () {
        Route::get('info/{userid}', 'MemberController@memberInfo');
        Route::get('/', 'MemberController@memberHome');
    });
});
// Route::get('/home', 'HomeController@index')->name('home');
