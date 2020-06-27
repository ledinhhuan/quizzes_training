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

Route::group(['namespace' => 'Home'], function () {
    Route::get('/', 'IndexController@index')->name('home');
    Route::get('search', 'SearchController@index')->name('search.index');
    Route::get('/topics', 'TopicController@showAllTopic')->name('topics.home.index');
    Route::get('/t/{slug}/{level}', 'QuizController@showQuizz')->name('quizz.show');
    Route::get('results', 'TestResultController@historyResults')->name('result.history_result');
    Route::get('results/{id}', 'TestResultController@showResult')->name('result.show');
    Route::delete('results/{id}', 'TestResultController@deleteTestResult')->name('quizz.delete');
    Route::post('/quizz', 'QuizController@doQuizz')->name('quizz.store');
});

Route::group(['namespace' => 'Auth'], function () {
    Route::get('/login', 'AuthenController@showLogin')->name('login.show');
    Route::get('/register', 'AuthenController@showRegister')->name('register.show');
    Route::post('/login', 'AuthenController@doLogin')->name('login.store');
    Route::post('/register', 'AuthenController@doRegister')->name('register.store');
    Route::post('/logout', 'AuthenController@logout')->name('logout');
});
