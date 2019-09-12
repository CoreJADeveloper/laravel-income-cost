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

// Auth::routes();

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::middleware(['auth'])->group(function () {
  Route::get('/brands', 'BrandsController@index');
  Route::get('/brands/create', 'BrandsController@create');
  Route::post('/brands/store', 'BrandsController@store');

  Route::get('/records/create', 'RecordsController@create');
  Route::get('/records/autocomplete', 'RecordsController@autocomplete');
  Route::post('/records/create/sell-cement', 'RecordsController@create_sell_cement_entities');

  Route::post('/get-custom-template', 'HelperController@render_custom_template');
  Route::post('/get-existing-user-information', 'HelperController@render_existing_customer_template');
});

Route::get('/home', 'HomeController@index')->name('home');
