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

Route::resource('monitoring','MonitoringController');

Route::get('monitoring/inputpr/{id}/edit','MonitoringController@createpr')->name('inputpr');
Route::patch('monitoring/updatepr/{id}','MonitoringController@storepr')->name('updatepr');

Route::get('monitoring/inputpo/{id}/edit','MonitoringController@createpo')->name('inputpo');
Route::patch('monitoring/updatepo/{id}','MonitoringController@storepo')->name('updatepo');

Route::get('monitoring/inputspb/{id}/edit','MonitoringController@createspb')->name('inputspb');
Route::patch('monitoring/updatespb/{id}','MonitoringController@storespb')->name('updatespb');

Route::get('monitoring/datatables',array('as'=>'monitoring.datatables','uses'=>'MonitoringController@datatables'));