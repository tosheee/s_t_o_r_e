<?php

Route::get('/', 'StoreController@index');

View::composer('*', function($view) { $view->with('categoriesButtonsName', App\Admin\Category::all()); });

View::composer('*', function($view) { $view->with('subCategoriesButtonsName', App\Admin\SubCategory::all()); });

View::composer('*', function($view) {$view->with('subCategories', App\Admin\SubCategory::all());});

View::composer('*', function($view) {
    $view->with('pagesButtonsRender', App\Admin\Page::where('active_page', true)->get());
});


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



Route::get('/page', [
    'uses' => 'StoreController@getShowPages',
    'as'  => 'store.showPage'
]);

Route::get('/store', [
    'uses' => 'StoreController@index',
    'as'   => 'store.index'
]);

Route::get('/store/search', [
    'uses' => 'StoreController@search',
    'as'   => 'store.search'
]);

Route::get('/store/{id}', [
    'uses' => 'StoreController@show',
    'as'   => 'store.show'
]);

Route::get('/add-to-cart/{id}', [
   'uses' => 'StoreController@getAddToCart',
    'as'  => 'store.addToCart'
]);

Route::get('/reduce/{id}', [
    'uses' => 'StoreController@getReduceByOne',
    'as'  => 'store.reduceByOne'
]);

Route::get('/increase/{id}', [
    'uses' => 'StoreController@getIncreaseByOne',
    'as'  => 'store.increaseByOne'
]);

Route::get('/remove/{id}', [
    'uses' => 'StoreController@getRemoveItem',
    'as'  => 'store.remove'
]);

Route::get('/checkout', [
    'uses' => 'StoreController@getCheckout',
    'as'  => 'store.checkout'
]);

Route::post('/checkout', [
    'uses' => 'StoreController@postCheckout',
    'as'  => 'store.checkout'
]);

Route::get('/shopping-cart', [
    'uses' => 'StoreController@getCart',
    'as'  => 'store.shoppingCart'
]);

// Admin

Route::get('/admin/products/search', [
    'uses' => 'Admin\ProductsController@search_category',
    'as'   => 'search_category'
]);

Route::get ('/admin/dashboard', 'AdminController@index');

Route::delete ('/admin/dashboard/{id}', 'AdminController@destroy');


Route::get ('/admin', 'Admin\LoginController@showLoginForm')->name('admin.login');

Route::post('/admin', 'Admin\LoginController@login');

Route::resource('/admin/categories', 'Admin\CategoriesController');

Route::resource('/admin/sub_categories', 'Admin\SubCategoriesController');

Route::resource('/admin/products', 'Admin\ProductsController');

Route::resource('/admin/users', 'Admin\UserController');

Route::resource('/admin/admins', 'Admin\AdminController');

Route::resource('/admin/pages', 'Admin\PagesController');

