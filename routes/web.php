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

Route::get('/home','LoginPagesController@home');
//Route::get('/home','StaticPagesController@home');
Route::get('/help','StaticPagesController@help');
Route::get('/about','StaticPagesController@about');


// Authentication Routes...
//Auth::routes();
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
//Route::get('/home', 'HomeController@index')->name('home');

//Users Routes...
//Route::resource('users','UserController',['only' => ['show','update','edit']]);
Route::get('/users/{user}','UsersController@show') -> name('users.show');
Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
Route::patch('/users/{user}', 'UsersController@update')->name('users.update');

//Users show page Routes...

Route::resource('topics', 'TopicsController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);
//Route::resource('classes', 'ClassesController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);

//Klasses Routes...
//Route::resource('klasses', 'KlassesController', ['only' => ['show']]);
Route::get('/klasses/{klasse}','KlassesController@show') -> name('klasses.show');