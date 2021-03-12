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


Route::middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('file', 'FileController')->except([
         'edit', 'update'
    ]);

});
Route::get('/download/{id}', 'FileController@download')->name('download');
Route::get('/{slug}', 'FileController@show')->name('file');
