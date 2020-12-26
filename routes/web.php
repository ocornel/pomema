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

Route::get('/patients', 'PatientController@index')->name('patients');
Route::get('/create_patient', 'PatientController@create')->name('create_patient');
Route::post('/store_patient', 'PatientController@store')->name('store_patient');
Route::get('/show_patient/{patient}/{last_name?}', 'PatientController@show')->name('show_patient');
Route::get('/edit_patient/{patient}/{last_name?}', 'PatientController@edit')->name('edit_patient');
Route::post('/update_patient/{patient}', 'PatientController@update')->name('update_patient');
Route::get('/delete_patient/{patient}', 'PatientController@destroy')->name('delete_patient');



Route::get('/credits', 'CreditCOntroller@index')->name('credits');
//Route::get('/reports', 'HomeController@index')->name('reports');
