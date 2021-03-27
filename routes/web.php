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

    
    
    Route::get('brands','BrandsController@index')->name('brands.index');
    Route::get('/brands/create','BrandsController@create')->name('brands.create');
    Route::post('/brands/create','BrandsController@store')->name('brands.store');
    Route::get('/brands/edit/{id}','BrandsController@edit')->name('brands.edit');
    Route::post('/brands/edit/{id}','BrandsController@update')->name('brands.update');
    Route::delete('/brands/destroy/{id}','BrandsController@destroy')->name('brands.destroy');


    Route::get('users','UsersController@index')->name('users.index');
    Route::get('/users/create','UsersController@create')->name('users.create');
    Route::post('/users/create','UsersController@store')->name('users.store');
    Route::get('/users/edit/{id}','UsersController@edit')->name('users.edit');
    Route::post('/users/edit/{id}','UsersController@update')->name('users.update');
    Route::delete('/users/destroy/{id}','UsersController@destroy')->name('users.destroy');

   

    Route::get('reports', 'ReportsController@index')->name('reports');
    Route::get('reports/sales', 'ReportsController@sales')->name('reports.sales');
    Route::post('reports/sales', 'ReportsController@salesDate')->name('reports.salesDate');
    Route::get('reports/platforms', 'ReportsController@platforms')->name('reports.platforms');
    Route::post('reports/platforms', 'ReportsController@platformsDate')->name('reports.platformsDate');
    Route::get('reports/categories', 'ReportsController@categories')->name('reports.categories');
    Route::post('reports/categories', 'ReportsController@categoriesDate')->name('reports.categoriesDate');
    Route::get('reports/products', 'ReportsController@products')->name('reports.products');
    Route::post('reports/products', 'ReportsController@productsDate')->name('reports.products');


});
