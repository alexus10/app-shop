<?php

use App\Http\Controllers\TestController;

Route::get('/', 'TestController@welcome');

Auth::routes();

Route::get('/search', 'SearchController@show'); //buscar producto
Route::get('/products/json', 'SearchController@data'); //data buscador predictivo

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/products/{id}', 'ProductController@show'); //mostrar producto
Route::get('/categories/{category}', 'CategoryController@show'); //mostrar producto categoria

Route::post('/cart', 'CartDetailController@store'); //registrar
Route::delete('/cart', 'CartDetailController@destroy'); //eliminar producto

Route::post('/order', 'CartController@update'); //eliminar producto

Route::middleware(['auth', 'admin'])->prefix('admin')->namespace('Admin')->group(function(){
    // al colocar el prefijo ('admin') ya no es necesario colocarlo en la ruta get('/admin/products'
    Route::get('/products', 'ProductController@index'); //listado
    Route::get('/products/create', 'ProductController@create'); //formulario
    Route::post('/products', 'ProductController@store'); //registrar
    Route::get('/products/{id}/edit', 'ProductController@edit'); //formulario edición
    Route::post('/products/{id}/edit', 'ProductController@update'); //actualizar
    Route::delete('/products/{id}', 'ProductController@destroy'); //formulario eliminar

    Route::get('/products/{id}/images', 'ImageController@index'); //listado
    Route::post('/products/{id}/images', 'ImageController@store'); //registrar
    Route::delete('/products/{id}/images', 'ImageController@destroy'); //formulario eliminar
    Route::get('/products/{id}/images/select/{imagen}', 'ImageController@select'); //destacar imagen

    Route::get('/categories', 'CategoryController@index'); //listado
    Route::get('/categories/create', 'CategoryController@create'); //formulario
    Route::post('/categories', 'CategoryController@store'); //registrar
    Route::get('/categories/{category}/edit', 'CategoryController@edit'); //formulario edición
    Route::post('/categories/{category}/edit', 'CategoryController@update'); //actualizar
    Route::delete('/categories/{category}', 'CategoryController@destroy'); //formulario eliminar
});
