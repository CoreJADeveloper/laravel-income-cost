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
  Route::get('/brands/{id}', 'BrandsController@get_brand_records');
  Route::post('/brands/store', 'BrandsController@store');

  Route::get('/records/create', 'RecordsController@create');
  Route::get('/records/autocomplete', 'RecordsController@autocomplete');

  Route::get('/customers/', 'RecordsController@get_all_customers');
  Route::get('/customers/{id}', 'RecordsController@get_customer_records');

  Route::post('/records/create/sell-cement', 'RecordsController@create_sell_cement_entities');
  Route::post('/records/create/sell-rod', 'RecordsController@create_sell_rod_entities');
  Route::post('/records/create/buy-cement', 'RecordsController@create_buy_cement_entities');
  Route::post('/records/create/buy-rod', 'RecordsController@create_buy_rod_entities');
  Route::post('/records/create/customer-cost', 'RecordsController@create_customer_cost_entities');
  Route::post('/records/create/customer-due-collection', 'RecordsController@create_customer_due_collection_entities');
  Route::post('/records/create/company-cost', 'RecordsController@create_company_cost_entities');
  Route::post('/records/create/company-due', 'RecordsController@create_company_due_entities');
  Route::post('/records/create/bank-saving', 'RecordsController@create_bank_saving_entities');
  Route::post('/records/create/employee-salary', 'RecordsController@create_employee_salary_entities');
  Route::post('/records/create/other-cost', 'RecordsController@create_other_cost_entities');

  Route::post('/get-custom-template', 'HelperController@render_custom_template');
  Route::post('/get-existing-user-information', 'HelperController@render_existing_customer_template');
  Route::post('/get-existing-brand-information', 'HelperController@render_existing_brand_template');
});

Route::get('/home', 'HomeController@index')->name('home');
