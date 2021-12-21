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

Route::get('/', 'MainTableController@index')->name("home");
Route::get('/light', 'MainTableController@index2')->name("light_home");
Route::post('/generateSheet', 'MainTableController@generateSheet')->name("generateSheet");
Route::post('changeInput', 'MainTableController@changeInput')->name("changeInput");
Route::post('addAirplane', 'MainTableController@addAirplane')->name("addAirplane");
Route::post('removeAirplane', 'MainTableController@removeAirplane')->name("removeAirplane");

Route::post('changeParam', 'CalculatorController@changeInput')->name("changeParam");
Route::post('/login', 'CalculatorController@login')->name("login");
Route::get('/login', 'CalculatorController@loginForm')->name("loginForm");
