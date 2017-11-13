<?php

Route::get('/ghost', function () {
    return abort(404, 'These are not the droids you are looking for.');
})->name('ghost');

Route::get('/rss', 'Stories@rss')->name('rss');
Route::post('/search', 'Search@redirect')->name('search');
Route::get('/search/{query}', 'Search@results')->name('search.results');
Route::get('/tagged/{tag}', 'Stories@tag')->name('tag');
Route::get('/{story}', 'Stories@single')->name('single');
Route::paginate('/', 'Stories@home')->name('home');
