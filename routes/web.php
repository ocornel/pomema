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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//PATIENT
Route::get('/patients', 'PatientController@index')->name('patients');
Route::get('/create_patient', 'PatientController@create')->name('create_patient');
Route::post('/store_patient', 'PatientController@store')->name('store_patient');
Route::get('/show_patient/{patient}/{last_name?}', 'PatientController@show')->name('show_patient');
Route::get('/edit_patient/{patient}/{last_name?}', 'PatientController@edit')->name('edit_patient');
Route::post('/update_patient/{patient}', 'PatientController@update')->name('update_patient');
Route::get('/delete_patient/{patient}', 'PatientController@destroy')->name('delete_patient');

//CREDIT
Route::get('/credits', 'CreditController@index')->name('credits');
Route::get('/create_credit', 'CreditController@create')->name('create_credit');
Route::post('/store_credit', 'CreditController@store')->name('store_credit');
Route::get('/show_credit/{credit}/', 'CreditController@show')->name('show_credit');
Route::get('/edit_credit/{credit}/', 'CreditController@edit')->name('edit_credit');
Route::post('/update_credit/{credit}', 'CreditController@update')->name('update_credit');
Route::get('/delete_credit/{credit}', 'CreditController@destroy')->name('delete_credit');

//NEXT OF KINS
Route::get('/noks', 'NextOfKinController@index')->name('noks');
Route::get('/create_nok', 'NextOfKinController@create')->name('create_nok');
Route::post('/store_nok', 'NextOfKinController@store')->name('store_nok');
Route::get('/show_nok/{nok}/', 'NextOfKinController@show')->name('show_nok');
Route::get('/edit_nok/{nok}/', 'NextOfKinController@edit')->name('edit_nok');
Route::post('/update_nok/{nok}', 'NextOfKinController@update')->name('update_nok');
Route::get('/delete_nok/{nok}', 'NextOfKinController@destroy')->name('delete_nok');


//Route::get('/reports', 'HomeController@index')->name('reports');
