<?php

\Auth::loginusingid(1);

Route::get('/', '\Todos\Controllers\TodosController@landing');
Route::get('/todos', '\Todos\Controllers\TodosController@index');
Route::post('/todos', '\Todos\Controllers\TodosController@store');
Route::put('/todos/{todo}', '\Todos\Controllers\TodosController@update');
Route::delete('/todos/{todo}', '\Todos\Controllers\TodosController@destroy');