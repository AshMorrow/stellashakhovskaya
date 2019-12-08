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

Route::get('/collections/karnavalnyie-kostyumyi','CollectionMain@showGallery');
Route::get('/collections/detskie-platya','CollectionMain@showGallery');
Route::get('/collections/evening-dress','CollectionMain@showGallery');

Route::get('/collections', 'CollectionMain@showAll');
Route::get('/collections/{name}', 'CollectionMain@show');
Route::get('/collections/{name}/{coll_name}', 'CollectionMain@showCollection');
Route::get('/collections/{name}/{coll_name}/{dress}', 'CollectionMain@showDress');

//Route::get('/create', 'CreateController@processed');


//Auth::routes();
//
//Route::get('/home', 'HomeController@index');
