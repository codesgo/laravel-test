<?php


Route::group(['prefix' => config('laraback.basic.prefix'), 'middleware' => 'checkrole:admin', 'namespace' => '\Codesgo\Laraback\Http\Controllers'], function () {

	Route::get('laraback', 'HomeController@index');

	Route::get('foo', function () {
		return 'Hello World main laraback foo.';
	});

	Route::get('/', function () {
		return 'Laraback Admin Home!';
	});
});
