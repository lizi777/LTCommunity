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

Route::get('/','LoginPagesController@homePage');
Route::get('/home','LoginPagesController@home');
// Route::get('/help','StaticPagesController@help');
// Route::get('/about','StaticPagesController@about');

Route::get('/signup', 'UsersController@create')->name('signup');
Route::post('/store', 'UsersController@store')->name('users.store');
Route::post('/signup/classes','UsersController@classes')->name('users.classes');
Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');
// Authentication Routes...
//Auth::routes();
// Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('login', 'Auth\LoginController@login');
// Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//Reconfiguration Auth
Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');

// Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

// // Password Reset Routes...
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset');
//Route::get('/home', 'HomeController@index')->name('home');

//Users Routes...
//Route::resource('users','UserController',['only' => ['show','update','edit']]);
Route::get('/users/{user}','UsersController@show') -> name('users.show');
Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
Route::patch('/users/{user}', 'UsersController@update')->name('users.update');

//Users show page Routes...

Route::resource('topics', 'TopicsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
//Route::resource('classes', 'ClassesController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::get('topics/{topic}/{slug?}','TopicsController@show')->name('topics.show');
//Image Upload...
Route::post('/topics/upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');
//Klasses Routes...
//Route::resource('klasses', 'KlassesController', ['only' => ['show']]);



Route::resource('activities', 'ActivitiesController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);
//Image Upload...
Route::post('/activities/upload_image', 'ActivitiesController@uploadImage')->name('activities.upload_image');


Route::get('/klasses/{klasse?}','KlassesController@show') -> name('klasses.show');
Route::resource('replies', 'RepliesController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::resource('fileuploads', 'FileuploadsController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);