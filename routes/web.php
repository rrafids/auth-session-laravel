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

// User
Route::get('/', 'UserController@index');
Route::get('/register', 'UserController@registerPage')->name('registerPageUser');
Route::post('/postRegister', 'UserController@postRegister')->name('registerUser');
Route::get('/login', 'UserController@loginPage')->name('loginPageUser');
Route::post('/postLogin', 'UserController@postLogin')->name('loginUser');
Route::get('/logout', 'UserController@logout')->name('logoutUser');
Route::post('/daftar_tim', 'UserController@daftarTim')->name('daftarTim');


// Admin
Route::get('/admin', 'AdminController@index');
Route::get('/admin/register', 'AdminController@registerPage')->name('registerPageAdmin');
Route::post('/admin/postRegister', 'AdminController@postRegister')->name('registerAdmin');
Route::get('/admin/login', 'AdminController@loginPage')->name('loginPageAdmin');
Route::post('/admin/postLogin', 'AdminController@postLogin')->name('loginAdmin');
Route::get('/admin/logout', 'AdminController@logout')->name('logoutAdmin');
Route::post('/admin/activate', 'AdminController@activate')->name('activate');
Route::post('/admin/deactivate', 'AdminController@deactivate')->name('deactivate');
