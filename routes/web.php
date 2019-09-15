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

Route::get('/dashboard', 'AdminController@index');
Route::get('/rekening', 'RekeningController@create');
Route::get('/rekening/{level}', 'RekeningController@index');
Route::post('/rekening/store', 'RekeningController@store');

Route::get('/', 'HomeController@index');
Route::get('/details/{id}', 'HomeController@details');
Route::post('/details', 'HomeController@count');
Route::post('/invoice/{id}', 'InvoiceController@store');
Route::get('/invoice', 'InvoiceController@index');

Auth::routes();
