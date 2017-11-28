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

Route::group(['prefix' => 'admin'], function () {
    Auth::routes();
    
});

Route::resource('/survey', 'Guest\SurveyController');
Route::post('/survey/participant/currency', 'Guest\ParticipantController@getParticipantCurrency');
Route::apiResource('/survey/participant', 'Guest\ParticipantController');
Route::apiResource('/survey/mimo', 'Guest\MimoController');
Route::apiResource('/survey/balance-sheet', 'Guest\BalanceSheetController');
Route::get('/home', 'HomeController@index')->name('home');
