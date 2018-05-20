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

Route::get('monitoring/datatables', 'MonitoringController@datatables')->name('monitoring.datatables');
		
Route::resource('monitoring','MonitoringController');

Route::get('monitoring/inputpr/{id}/input','MonitoringController@createpr')->name('inputpr');
Route::patch('monitoring/updatepr/{id}','MonitoringController@storepr')->name('updatepr');
Route::get('monitoring/showpr/{id}','MonitoringController@showpr')->name('showpr');
Route::get('monitoring/pr/{id}/edit','MonitoringController@editpr')->name('editpr');

Route::get('monitoring/inputpo/{id}/input','MonitoringController@createpo')->name('inputpo');
Route::patch('monitoring/updatepo/{id}','MonitoringController@storepo')->name('updatepo');
Route::get('monitoring/showpo/{id}','MonitoringController@showpo')->name('showpo');
Route::get('monitoring/po/{id}/edit','MonitoringController@editpo')->name('editpo');

Route::get('monitoring/inputspb/{id}/input','MonitoringController@createspb')->name('inputspb');
Route::patch('monitoring/updatespb/{id}','MonitoringController@storespb')->name('updatespb');
Route::get('monitoring/showspb/{id}','MonitoringController@showspb')->name('showspb');
Route::get('monitoring/spb/{id}/edit','MonitoringController@editspb')->name('editspb');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');