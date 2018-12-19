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
Route::get('translation/excel', 'DefaultController@excel');
Route::post('translation/excel', 'DefaultController@importTranslation');
