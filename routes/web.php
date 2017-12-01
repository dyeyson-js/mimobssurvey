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

Route::get('/survey', 'Guest\SurveyController@index')->name('survey.index');
Route::get('/survey/mimopbs', 'Guest\SurveyController@showMimoBsForm')->name('survey.mimopbs');

Route::post('/api/survey/participant/currency', 'Guest\ParticipantController@getParticipantCurrency');
Route::post('/api//survey/download', 'Guest\DownloadController@generatePDF')->name('survey.download');
Route::apiResource('/api/survey', 'Guest\SurveyController', ['only' => ['store']]);
Route::apiResource('/api/survey/participant', 'Guest\ParticipantController', ['only' => ['store', 'update']]);
Route::apiResource('/api/survey/mimo', 'Guest\MimoController', ['only' => ['store', 'update']]);
Route::apiResource('/api/survey/balance-sheet', 'Guest\BalanceSheetController', ['only' => ['store', 'update']]);