<?php

Route::get('/', 'QuotesController@index')->name('quotes.index');
Route::post('/quotes', 'QuotesController@store')->name('quotes.store');

Route::get('login', 'Auth\LoginController@redirectToProvider')->name('auth.login');
Route::get('login/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('logout', 'Auth\LoginController@logout')->name('auth.logout');

Route::get('tweet/{quote}', 'TweetsController@store')->name('tweets.store');
