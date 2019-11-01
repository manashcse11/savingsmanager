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

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('transaction', 'TransactionController')->middleware('auth');
Route::get('transaction/{transaction}/delete', 'TransactionController@delete')->name('transaction.delete')->middleware('auth'); // Manually delete using GET method
Route::resource('report', 'ReportController')->middleware('auth');
