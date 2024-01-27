<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/motor/create', 'MotorController@store');
Route::get('/motor/edit/{id}', 'MotorController@edit');
Route::post('/motor/update/{id}', 'MotorController@update');
Route::delete('/motor/delete/{id}', 'MotorController@delete');
Route::get('/motors', 'MotorController@index');
Route::get('/motor/show/{id}', 'MotorController@show');

Route::post('/task/create', 'TaskController@store');
Route::get('/task/edit/{id}', 'TaskController@edit');
Route::post('/task/update/{id}', 'TaskController@update');
Route::delete('/task/delete/{id}', 'TaskController@delete');
Route::get('/tasks/{id}', 'TaskController@index');

Route::post('/service/create', 'ServiceController@store');
Route::get('/service/edit/{id}', 'ServiceController@edit');
Route::post('/service/update/{id}', 'ServiceController@update');
Route::delete('/service/delete/{id}', 'ServiceController@delete');
Route::get('/services/{id}', 'ServiceController@index');

Route::post('/links/create', 'LinksController@store');
Route::get('/links/edit/{id}', 'LinksController@edit');
Route::post('/links/update/{id}', 'LinksController@update');
Route::delete('/links/delete/{id}', 'LinksController@delete');
Route::get('/links', 'LinksController@index');
Route::get('/links/show/{id}', 'LinksController@show');
