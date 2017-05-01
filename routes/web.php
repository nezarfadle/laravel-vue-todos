<?php

\Auth::loginusingid(1);

Route::get('/', '\Todos\Controllers\TodosController@landing');
Route::get('/todos', '\Todos\Controllers\TodosController@index');
Route::post('/todos', '\Todos\Controllers\TodosController@store');
Route::delete('/todos/{id}', '\Todos\Controllers\TodosController@destroy');
Route::put('/todos/{id}', '\Todos\Controllers\TodosController@update');