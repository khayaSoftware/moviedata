<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});
Route::get('register', function () {
    return view('auth\register');
});

Route::post('register', [
    'as' => 'register', 
    'uses' => 'Auth\RegisterController@create'
  ]);

Route::get('login', function () {
    return view('auth\login');
});

Route::post('login', [
    'as' => 'login', 
    'uses' => 'Auth\LoginController@login'
  ]);


Route::post('logout', [
    'as' => 'logout', 
    'uses' => 'Auth\LoginController@logout'
]);