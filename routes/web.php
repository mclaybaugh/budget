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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('template', 'TemplateController')->except(['show']);
Route::resource('balance', 'BalanceController')->except(['show']);

// Generate transactions for a time period.
Route::get('/transaction/generate', 'TransactionController@generate');
Route::post('/transaction/run', 'TransactionController@run');
Route::get('/transaction/month/{year}/{month}', 'TransactionController@month')
  ->where(['year' => '[0-9]{4}', 'month' => '[0-9]{2}']);
Route::resource('transaction', 'TransactionController')->except(['show']);

Auth::routes();
