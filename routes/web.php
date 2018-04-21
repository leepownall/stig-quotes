<?php

Route::get('/', 'QuotesController@index')->name('quotes.index');

Route::post('/quotes', 'QuotesController@store')->name('quotes.store');
Route::delete('/quotes/{quote}', 'QuotesController@destroy')->name('quotes.destroy')->middleware('can:delete,quote');
Route::get('/quotes/{quote}/edit', 'QuotesController@edit')->name('quotes.edit')->middleware('can:edit,quote');
Route::put('/quotes/{quote}', 'QuotesController@update')->name('quotes.update')->middleware('can:edit,quote');

Route::get('login', 'Auth\LoginController@redirectToProvider')->name('auth.login');
Route::get('login/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('logout', 'Auth\LoginController@logout')->name('auth.logout');

Route::get('tweet/{quote}', 'TweetsController@store')->name('tweets.store');

Route::prefix('settings')->group(function () {
    Route::get('/', 'SettingsController@index')->name('settings.index')->middleware('auth');
    Route::get('account/delete', 'AccountController@destroy')->name('account.delete')->middleware('auth');
});
