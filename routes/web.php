<?php


Route::get('/todos/create', '\Todos\Controllers\TodosController@create');
Route::get('/todos', '\Todos\Controllers\TodosController@index');
Route::post('/todos', '\Todos\Controllers\TodosController@store');
Route::delete('/todos/{id}', '\Todos\Controllers\TodosController@destroy');
Route::put('/todos', '\Todos\Controllers\TodosController@update');