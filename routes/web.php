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


    Route::get('boxes','BoxController@index')->name('boxes.index');
    Route::get('/boxes/create','BoxController@create')->name('boxes.create');
    Route::post('/boxes/create','BoxController@store')->name('boxes.store');
    Route::get('/boxes/edit/{id}','BoxController@edit')->name('boxes.edit');
    Route::post('/boxes/edit/{id}','BoxController@update')->name('boxes.update');
    Route::delete('/boxes/destroy/{id}','BoxController@destroy')->name('boxes.destroy');
    Route::get('/boxes/configure/{id}','BoxController@configure')->name('boxes.configure');
    Route::post('/boxes/configure/{id}','BoxController@configurePost')->name('boxes.configurepost');
    Route::delete('/boxes/configure/destroy/{id}','BoxController@configureDestroy')->name('boxes.configuredestroy');
    Route::get('/boxes/sale/{id}','BoxController@sale')->name('boxes.sale');
    Route::post('/boxes/sale/client/{id}','BoxController@clientStore')->name('boxes.clientStore');

    
    Route::get('box_types','BoxTypeController@index')->name('box_types.index');
    Route::get('/box_types/create','BoxTypeController@create')->name('box_types.create');
    Route::post('/box_types/create','BoxTypeController@store')->name('box_types.store');
    Route::get('/box_types/edit/{id}','BoxTypeController@edit')->name('box_types.edit');
    Route::post('/box_types/edit/{id}','BoxTypeController@update')->name('box_types.update');
    Route::delete('/box_types/destroy/{id}','BoxTypeController@destroy')->name('box_types.destroy');
  
    Route::get('products','ProductController@index')->name('products.index');
    Route::get('/products/create','ProductController@create')->name('products.create');
    Route::post('/products/create','ProductController@store')->name('products.store');
    Route::get('/products/edit/{id}','ProductController@edit')->name('products.edit');
    Route::post('/products/edit/{id}','ProductController@update')->name('products.update');
    Route::delete('/products/destroy/{id}','ProductController@destroy')->name('products.destroy');
    Route::get('/products/fifo/{id}','ProductController@fifo')->name('products.fifo');
    Route::delete('/products/merma/{id}','ProductController@merma')->name('products.merma');
    Route::delete('/products/sold/{id}','ProductController@sold')->name('products.sold');
    

    Route::get('product_types','ProductTypeController@index')->name('product_types.index');
    Route::get('/product_types/create','ProductTypeController@create')->name('product_types.create');
    Route::post('/product_types/create','ProductTypeController@store')->name('product_types.store');
    Route::get('/product_types/edit/{id}','ProductTypeController@edit')->name('product_types.edit');
    Route::post('/product_types/edit/{id}','ProductTypeController@update')->name('product_types.update');
    Route::delete('/product_types/destroy/{id}','ProductTypeController@destroy')->name('product_types.destroy');

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

    
    Route::get('entries','EntryController@index')->name('entries.index');
    Route::get('/entries/create','EntryController@create')->name('entries.create');
    Route::post('/entries/create','EntryController@store')->name('entries.store');
    Route::get('/entries/edit/{id}','EntryController@edit')->name('entries.edit');
    Route::post('/entries/edit/{id}','EntryController@update')->name('entries.update');
    Route::delete('/entries/destroy/{id}','EntryController@destroy')->name('entries.destroy');
    Route::get('/entries/show/{id}','EntryController@show')->name('entries.show');


    Route::get('paymentmethods','PaymentMethodController@index')->name('paymentmethods.index');
    Route::get('/paymentmethods/create','PaymentMethodController@create')->name('paymentmethods.create');
    Route::post('/paymentmethods/create','PaymentMethodController@store')->name('paymentmethods.store');
    Route::get('/paymentmethods/edit/{id}','PaymentMethodController@edit')->name('paymentmethods.edit');
    Route::post('/paymentmethods/edit/{id}','PaymentMethodController@update')->name('paymentmethods.update');
    Route::delete('/paymentmethods/destroy/{id}','PaymentMethodController@destroy')->name('paymentmethods.destroy');

    Route::get('boxbuilding', 'BoxController@building')->name('boxbuilding');
    Route::get('boxbuildingstep2/{id}', 'BoxController@boxbuildingstep2')->name('boxbuildingstep2');
    Route::post('boxbuildings/saveBuild', 'BoxController@saveBuild')->name('boxbuildingsave');
    Route::get('builtboxes', 'BoxController@builtboxes')->name('builtboxes');

    ///Reportes

    Route::get('reports', 'ReportsController@index')->name('reports');
    Route::get('reports/cashflow', 'ReportsController@cashflow')->name('reports.cashflow');
    Route::post('reports/cashflow', 'ReportsController@cashflowDate')->name('reports.cashflowDate');
    Route::get('reports/expiration', 'ReportsController@expiration')->name('reports.expiration');


});
