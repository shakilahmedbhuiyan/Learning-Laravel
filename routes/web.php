<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', 'UserController@index')->name('home');

/*
 * user profile
 */
Route::get('/profile', 'UserController@profile')->name('profile');
Route::get('/profile/edit','UserController@editProfile')->name('editProfile.user');
Route::POST('/profile/edit','UserController@updateProfile');
Route::POST('/profile/edit','UserController@updateProfile')->name('editProfileImage.user');


/**
 * Admin Login
 */
Route::get('/admin/home', 'AdminController@index');
Route::get('/admin', 'Admin\LoginController@showLoginForm')->name('login.admin');
Route::post('/admin', 'Admin\LoginController@login');

/**
 * Author Login
 */
Route::get('/author/home', 'AuthorController@index');
Route::get('/author', 'Author\LoginController@showLoginForm')->name('login.author');
Route::post('/author', 'Author\LoginController@login');


