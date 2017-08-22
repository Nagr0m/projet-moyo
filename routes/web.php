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
Route::get('actus', 'FrontController@postsIndex')->name('actus');
Route::get('actu/{id}', 'FrontController@postSingle')->name('actu');
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
    # Resources routes
    Route::resource('posts', 'PostController');
    Route::resource('questions', 'QuestionController');
    # Mass updating
    Route::match(['put', 'patch'], 'multiple/posts', 'PostController@multiplePatch')->name('posts.multiple');
    Route::match(['put', 'patch'], 'multiple/questions', 'QuestionController@multiplePatch')->name('questions.multiple');

    Route::get('students', function () {
        
    })->name('students.index');
});

# Student access
Route::namespace('Student')->prefix('student')->middleware(['auth', 'role:student'])->group(function () {
    Route::get('dashboard', 'DashboardController@index')->name('student/home');
    Route::get('questions', 'QuestionController@index')->name('student/questions');
    Route::get('question/{id}', 'QuestionController@answer')->name('student/question');
    Route::post('question/submit/{id}', 'QuestionController@submit')->name('student/submit');

});
