<?php

Route::get('/', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');

View::composer('*', function($view) { $view->with('categoriesButtonsName', App\Admin\Category::all()); });

View::composer('*', function($view) { $view->with('subCategoriesButtonsName', App\Admin\SubCategory::all()); });

View::composer('*', function($view) {$view->with('subCategories', App\Admin\SubCategory::all());});


Route::post('admin/products/create/{id?}', function($id = null) {

    $subCategoryAttributes = App\Admin\SubCategory::where('category_id', $id)->get();

    $subCategoryOptions = array();

    foreach($subCategoryAttributes as $key => $subCatAttribute)
    {
        $subCategoryOptions[$key] = [$subCatAttribute->id, $subCatAttribute->name, $subCatAttribute->identifier];
    }

    return $subCategoryOptions;
});

Auth::routes();

Route::get ('/store', 'StoreController@index');

Route::get ('/store/{id}', 'StoreController@show');

Route::get('/store', [
    'uses' => 'StoreController@index',
    'as'   => 'store.index'
]);

Route::get('/add-to-cart/{id}', [
   'uses' => 'StoreController@getAddToCart',
    'as'  => 'store.addToCart'
]);

Route::get('/shopping-cart', [
    'uses' => 'StoreController@getCart',
    'as'  => 'store.shoppingCart'
]);

Route::get('/checkout', [
    'uses' => 'StoreController@getCheckout',
    'as'  => 'checkout'
]);

Route::post('/checkout', [
    'uses' => 'StoreController@postCheckout',
    'as' => 'checkout'
]);

Route::get ('/admin/dashboard', 'AdminController@index');

Route::get ('/admin', 'Admin\LoginController@showLoginForm')->name('admin.login');

Route::post('/admin', 'Admin\LoginController@login');

Route::resource('/admin/categories', 'Admin\CategoriesController');

Route::resource('/admin/sub_categories', 'Admin\SubCategoriesController');

Route::resource('/admin/products', 'Admin\ProductsController');



