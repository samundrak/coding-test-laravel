<?php
Route::get('/views/partials/{template}', function ($template = 'home') {
	return view('partials/' . $template);
});