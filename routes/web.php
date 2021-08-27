<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware(['auth'])->group(function () {

    
    
    Route::get('suppliers','SupplierController@index')->name('suppliers.index');
    Route::get('/suppliers/create','SupplierController@create')->name('suppliers.create');
    Route::post('/suppliers/create','SupplierController@store')->name('suppliers.store');
    Route::get('/suppliers/edit/{id}','SupplierController@edit')->name('suppliers.edit');
    Route::post('/suppliers/edit/{id}','SupplierController@update')->name('suppliers.update');
    Route::delete('/suppliers/destroy/{id}','SupplierController@destroy')->name('suppliers.destroy');


    Route::get('thematics','ThematicController@index')->name('thematics.index');
    Route::get('/thematics/create','ThematicController@create')->name('thematics.create');
    Route::post('/thematics/create','ThematicController@store')->name('thematics.store');
    Route::get('/thematics/edit/{id}','ThematicController@edit')->name('thematics.edit');
    Route::post('/thematics/edit/{id}','ThematicController@update')->name('thematics.update');
    Route::delete('/thematics/destroy/{id}','ThematicController@destroy')->name('thematics.destroy');

    Route::get('getBrands','BrandsController@getBrands');//AJAX 
    Route::get('getPriceTags/{id}','BrandsController@getPriceTags');//AJAX 


    Route::get('users','UsersController@index')->name('users.index');
    Route::get('/users/create','UsersController@create')->name('users.create');
    Route::post('/users/create','UsersController@store')->name('users.store');
    Route::get('/users/edit/{id}','UsersController@edit')->name('users.edit');
    Route::post('/users/edit/{id}','UsersController@update')->name('users.update');
    Route::delete('/users/destroy/{id}','UsersController@destroy')->name('users.destroy');





});
