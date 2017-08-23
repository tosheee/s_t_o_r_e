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

View::composer('*', function($view) { $view->with('categoriesButtonsName', App\Admin\Category::all()); });

View::composer('*', function($view) { $view->with('subCategoriesButtonsName', App\Admin\SubCategory::all()); });






View::composer('*', function($view)
{
    $view->with('subCategories', App\Admin\SubCategory::all());
});

Auth::routes();
//Categories::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get ('/admin/dashboard', 'AdminController@index');
Route::get ('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Admin\LoginController@login');

Route::resource('admin/categories', 'Admin\CategoriesController');
Route::resource('admin/sub_categories', 'Admin\SubCategoriesController');
