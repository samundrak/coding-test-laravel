<?php
Route::post('/details', 'Details@create');
Route::get('/details', 'Details@index');
Route::get('/details/{id}', 'Details@show');