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
//Categories::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get ('/admin/dashboard', 'AdminController@index');
Route::get ('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Admin\LoginController@login');



//Route::get('/admin/categories', 'Admin\CategoriesController@index');
//Route::get('/admin/categories/create', 'Admin\CategoriesController@create');

Route::resource('admin/categories', 'Admin\CategoriesController');

