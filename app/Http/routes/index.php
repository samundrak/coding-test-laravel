<?php
require_once 'views.php';
Route::group(["prefix" => "/api"], function () {
	require_once 'api.php';
});