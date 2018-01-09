<?php

Route::get(
    config('laravel-opcache-clear.uri_slug'),
    'Maximkou\LaravelOpcacheClear\OpcacheClearController@clear'
);
