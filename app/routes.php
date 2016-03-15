<?php

$app->get('/', '\App\Controllers\HomeController@index')->name('home');

$app->get('/contact', '\App\Controllers\HomeController@contact')->name('contact');

$app->get('/signup', '\App\Controllers\AuthController@getSignUp')->name('signUp');

$app->post('/signup', '\App\Controllers\AuthController@postSignUp')->name('signUp.post');