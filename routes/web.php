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
    return view('layouts/pages/main_page');
});

Route::get('/about', function () {
    return view('layouts/pages/about');
});

Route::get('/contacts', function () {
    return view('layouts/pages/contacts');
});

Route::get('/search','SearchController@showSearchTemplate');
Route::get('/search_get_dress','SearchController@getSearchData');

Route::get('/send-massage','MailController@send');

//Route::get('mail',function (){
//   return view('emails/msg');
//});

Route::get('/favorite-dress','FavoriteDressController@show');

Route::get('/partition/karnavalnyie-kostyumyi', 'GalleryController@show');
Route::get('/partition/detskie-platya', 'GalleryController@show');
Route::get('/partition/evening-dress', 'GalleryController@show');

Route::get('/partition', 'PartitionController@list')->name('partition.list');
Route::get('/partition/{partition_name}', 'PartitionController@show')->name('partition.show');
Route::get('/partition/{partition_name}/collection/{collection_name}', 'CollectionController@show');
Route::get('/partition/{partition_name}/collection/{collection_name}/{dress}', 'DressController@showDress');


Auth::routes();
