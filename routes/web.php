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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Ajaxes
Route::get('/categories/subcategories/{category}', 'CategoryController@subcategories')->name('categories.subcategories');
Route::get('/quotes/like/{quote}', 'QuoteController@like')->name('quotes.like');

// Resources
Route::resource('quotes', 'QuoteController');
Route::resource('categories', 'CategoryController');
Route::resource('admin/categories', 'Admin\CategoryController', ['as' => 'admin'])->middleware('is_admin');
Route::resource('admin', 'Admin\DashboardController')->middleware('is_admin');
Route::resource('users', 'UserController');
Route::resource('interests', 'InterestController');
Route::resource('/', 'WelcomeController');