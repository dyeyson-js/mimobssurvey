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
    return redirect()->route('survey.index');
});

// Route::group(['prefix' => 'admin'], function () {
//     Auth::routes();
    
// });

Route::resource('/survey', 'Guest\SurveyController', ['only' => ['index', 'store']]);
Route::post('/survey/participant/currency', 'Guest\ParticipantController@getParticipantCurrency');
Route::post('/survey/download', 'Guest\DownloadController@generatePDF')->name('survey.download');
Route::apiResource('/survey/participant', 'Guest\ParticipantController', ['only' => ['store', 'update']]);
Route::apiResource('/survey/mimo', 'Guest\MimoController', ['only' => ['store', 'update']]);
Route::apiResource('/survey/balance-sheet', 'Guest\BalanceSheetController', ['only' => ['store', 'update']]);
Route::get('/home', 'HomeController@index')->name('home');
