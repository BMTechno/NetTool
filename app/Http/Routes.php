<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});

//Route::get('/equipments', 'EquipmentController@index');

Route::get('/equipment', 'EquipmentController@index');
Route::get('/equipment/{equipment}', 'EquipmentController@view');
Route::post('/equipment/{equipment}', 'EquipmentController@connect');
// Route::post('/equipment/{equipment}/command/{command}', 'EquipmentController@connect');

//Route::post('/equipments', 'EquipmentController@store');

Route::post('/equipment', 'EquipmentController@store');

//Route::delete('/equipments/{equipment}', 'EquipmentController@destroy');

Route::delete('/equipment/{equipment}', 'EquipmentController@destroy');

Route::auth();

Route::get('/home', 'HomeController@index');

