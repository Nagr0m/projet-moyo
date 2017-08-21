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

# Front
Route::get('/', 'FrontController@home')->name('home');
Route::get('actus', 'FrontController@actus')->name('actus');
Route::get('actu/{id}', 'FrontController@actu')->name('actu');
Route::get('lycee', 'FrontController@lycee')->name('lycee');
Route::get('mentionslegales', 'FrontController@mentionslegales')->name('mentionslegales');

Route::match(['get', 'post'], 'contact', 'FrontController@contact')->name('contact');

Route::post('comment', 'FrontController@comment')->name('comment');

# Authentification
Route::match(['get', 'post'], 'login', 'LoginController@login')->name('login');
Route::get('logout', 'LoginController@logout')->name('logout');

# Teacher back-office group
Route::namespace('Teacher')->prefix('teacher')->middleware(['auth', 'role:teacher'])->group(function () {
    
    Route::get('dashboard', 'DashboardController@index')->name('teacher/home');
    Route::get('students', function () {

    })->name('students.index');
    Route::resource('posts', 'PostController');
    Route::match(['put', 'patch'], 'multiple/posts', 'PostController@multiplePatch')->name('posts.multiple');
    Route::resource('questions', 'QuestionController');

});

# Student access
Route::namespace('Student')->prefix('student')->middleware(['auth', 'role:student'])->group(function () {

    Route::get('dashboard', 'DashboardController@index')->name('student/home');
    Route::get('questions', 'DashboardController@questions')->name('student/questions');

});
