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

Route::get('storage/image/{image}', 'ImageController@getImage')->name('storage.image');
Route::get('storage/image/size/{image}', 'ImageController@getImageSize')->name('storage.image.size');
Route::get('storage/document/{document}', 'DocumentController@getDocument')->name('storage.document');
Route::get('translation/excel/{device?}', 'DefaultController@excel');
