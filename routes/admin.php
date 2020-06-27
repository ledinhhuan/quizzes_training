<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth', 'admin']], function() {
    Route::get('/', 'AdminController@index')->name('admin.index');

    Route::resource('topics', 'AdminTopicController');
    Route::get('topics/active/{id}', 'AdminTopicController@active')->name('admin.get.active.topic');

    Route::resource('questions', 'AdminQuestionController');

    Route::resource('users', 'AdminUserController');
    Route::get('users/active/{id}', 'AdminUserController@active')->name('admin.get.active.user');

    Route::resource('results', 'AdminResultController');
});
