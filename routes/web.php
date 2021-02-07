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
    return view('landing_page');
})->name('landing');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//USERS
Route::get('/users', 'UserController@index')->name('users');
Route::get('/create_user', 'UserController@create')->name('create_user');
Route::post('/store_user', 'UserController@store')->name('store_user');
Route::get('/show_user/{user}/{last_name?}', 'UserController@show')->name('show_user');
Route::get('/edit_user/{user}/{last_name?}', 'UserController@edit')->name('edit_user');
Route::post('/update_user/{user}', 'UserController@update')->name('update_user');
Route::get('/delete_user/{user}', 'UserController@destroy')->name('delete_user');


//PATIENT
Route::get('/patients/{age_filter?}', 'PatientController@index')->name('patients');
Route::get('/create_patient', 'PatientController@create')->name('create_patient');
Route::post('/store_patient', 'PatientController@store')->name('store_patient');
Route::get('/show_patient/{patient}/{last_name?}', 'PatientController@show')->name('show_patient');
Route::get('/edit_patient/{patient}/{last_name?}', 'PatientController@edit')->name('edit_patient');
Route::post('/update_patient/{patient}', 'PatientController@update')->name('update_patient');
Route::get('/delete_patient/{patient}', 'PatientController@destroy')->name('delete_patient');
Route::get('/associate_nok/{patient}/{last_name?}', 'PatientController@associate_nok')->name('associate_nok');

//CREDIT
Route::get('/credits/{filter_status?}', 'CreditController@index')->name('credits');
Route::get('/create_credit/{patient}/{last_name?}', 'CreditController@create')->name('create_credit');
Route::post('/store_credit', 'CreditController@store')->name('store_credit');
Route::get('/show_credit/{credit}/{code?}/', 'CreditController@show')->name('show_credit');
Route::get('/edit_credit/{credit}/{code?}/', 'CreditController@edit')->name('edit_credit');
Route::post('/update_credit/{credit}', 'CreditController@update')->name('update_credit');
Route::post('/clear_credit', 'CreditController@clear_credit')->name('clear_credit');
Route::get('/delete_credit/{credit}/{code?}', 'CreditController@destroy')->name('delete_credit');

//NEXT OF KINS
Route::get('/noks', 'NextOfKinController@index')->name('noks');
Route::get('/create_nok/{nok_id?}/{patient?}/{is_primary?}', 'NextOfKinController@create')->name('create_nok');
Route::post('/store_nok', 'NextOfKinController@store')->name('store_nok');
Route::get('/show_nok/{nok}/', 'NextOfKinController@show')->name('show_nok');
Route::get('/edit_nok/{nok}/', 'NextOfKinController@edit')->name('edit_nok');
Route::post('/update_nok/{nok}', 'NextOfKinController@update')->name('update_nok');
Route::get('/delete_nok/{nok}', 'NextOfKinController@destroy')->name('delete_nok');
Route::get('/associate_patient/{nok}/{last_name?}', 'NextOfKinController@associate_patient')->name('associate_patient');
Route::get('/nok_patient_association', 'NextOfKinController@nok_patient_association')->name('nok_patient_association');

//REPORTS
Route::get('/patient_credit/{patient}/{format?}/}{last_name?}', 'ReportsController@patient_credit')->name('patient_credit_report');
Route::get('/dashboard_item_link/{title?}', 'HomeController@dashboard_item_link')->name('dashboard_item_link');


//EXTRAS
Route::get('/load_widget', 'HomeController@load_widget')->name('load_widget');
Route::get('template_code', 'UtilsController@template_code')->name('template_code');
