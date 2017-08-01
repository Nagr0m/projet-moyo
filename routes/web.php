<?php

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

Route::get('/', 'FrontController@home')->name('home');

# Authentification
Route::match(['get', 'post'], 'login', 'LoginController@login')->name('login');
Route::get('logout', 'LoginController@logout')->name('logout');

# Teacher back-office group
Route::namespace('Teacher')->middleware(['auth', 'role:teacher'])->group(function () {
        
});

# Student access
Route::namespace('Student')->middleware(['auth', 'role:student'])->group(function () {
    
});
