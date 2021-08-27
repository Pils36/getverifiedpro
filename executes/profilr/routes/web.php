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

// Route::get('/', function () {
//     return view('welcome');
// });

//Pages Route
Route::get('/', 'PagesController@home')->name('home');
Route::get('/service', 'PagesController@service')->name('service');
Route::get('/about', 'PagesController@about')->name('about');
Route::get('/join', 'PagesController@join')->name('join');
// Route::get('/contact', 'PagesController@contact')->name('contact');
Route::get('/donate', 'PagesController@donate')->name('donate');

// Policy Route
Route::get('render/{docs}', [ 'uses' => 'PagesController@render', 'as' => 'render']);

Auth::routes();


// Subscribe To Mail
Route::resource('subscribes', 'SubscribeController');
Route::get('mails', 'SubscribeController@sendMail');

// Contact Response
Route::resource('contact', 'ContactController');

//Ajax Route
Route::group(['prefix' => 'Ajax'], function() {
	Route::post('Account/Corporate', ['uses' => 'GetstartedController@index', 'as' => 'AjaxCorporate']);
	Route::post('Account/User', ['uses' => 'GetstartedController@user', 'as' => 'AjaxUser']);
});