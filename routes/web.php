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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

#Route::get('/home', 'HomeController@index')->name('home');
#Route::get('/report', 'HomeController@report')->name('report');
#Route::get('/show', 'HomeController@show');
Route::resource('report', 'HomeController');

Route::post('/upload', 'ExcelController@upload')->name('exce_upload');