<?php

use App\Providers\Route;

Route::get('home', 'TestController@index');

Route::middleware(['auth', 'is_adult'], function () {
    Route::get('test', 'TestController@index');

    Route::get('users/{id}', 'UsersController@show');

    Route::get('posts', 'PostController@index');
});
