<?php

$app->get('/', '\App\Controllers\HomeController@index')->name('home');

$app->get('/signup', '\App\Controllers\AuthController@getSignUp')->name('signUp');
$app->post('/signup', '\App\Controllers\AuthController@postSignUp')->name('signUp.post');

$app->get('/login', '\App\Controllers\AuthController@getSignIn')->name('singIn');
$app->post('/login', '\App\Controllers\AuthController@postSignIn')->name('singIn.post');