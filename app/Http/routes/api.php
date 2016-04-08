<?php
Route::post('/details', 'Details@create');
Route::get('/details', 'Details@show');
Route::get('/details/{id}', 'Details@index');