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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


/*
*  Customer Routes
*
*/
Route::prefix('customer')->group(function (){
    //Return a list of all customer
    Route::get('/store', 'CustomerController@getAll')->name('customer.store');
    //Return a list of customers that depends on a specific attribute
    Route::post('/atstore', 'CustomerController@getCustumersByAttributeDeterminate')->name('customer.store.attribute');
    //Create a cutomer in DB
    Route::post('/create', 'CustomerController@create')->name('custumer.create');
    //Update a cutomer in DB
    Route::post('/update', 'CustomerController@update')->name('customer.update');
    //Delete a cutomer in DB (state=>0)
    Route::post('/delete', 'CustomerController@delete')->name('customer.delete');
    //Restore a cutomer in DB (state=>1)
    Route::post('/restore', 'CustomerController@restore')->name('customer.delete');
    
});

/*
*  Concessionaire Routes
*
*/
Route::prefix('concessionaire')->group(function (){
    //Return a list of all Concessionaires
    Route::get('/store', 'ConcessionaireController@getAll')->name('concessionaire.store');
    //Return a list of Concessionaires with custom Data
    Route::get('/data', 'ConcessionaireController@getAllData')->name('concessionaire.store.data');
    
});


/*
*  Apartment  Routes
*
*/
Route::prefix('apartment')->group(function (){
    //Return a list of all Apartments
    Route::get('/store', 'ApartmentController@getAll')->name('apartment.store');
    
});

/*
*  Provincy  Routes
*
*/
Route::prefix('provincy')->group(function (){
    //Return a list of all Apartments
    Route::get('/store', 'ProvincyController@getAll')->name('provincy.store');
    
});

/*
*  District  Routes
*
*/
Route::prefix('district')->group(function (){
    //Return a list of all Apartments
    Route::get('/store', 'DistrictController@getAll')->name('district.store');
    
});