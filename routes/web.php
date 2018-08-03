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

Route::get('/', ['middleware' => 'guest', function() {
	return view('welcome');
}]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Ajaxes
Route::get('/categories/subcategories/{category}', 'CategoryController@subcategories')->name('categories.subcategories');

// Resources
Route::resource('quotes', 'QuoteController');
Route::resource('categories', 'CategoryController');
Route::resource('admin/categories', 'Admin\CategoryController', ['as' => 'admin']);
Route::resource('admin', 'Admin\DashboardController');