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

//Cart
Route::get('/gio-hang','CartController@index');
Route::get('gio-hang-rong','CartController@cartEmpty');
Route::get('thanh-toan-thanh-cong','CartController@success');
Route::get('/cart/destroy','CartController@destroy');
Route::post('/cart/update','CartController@update');
Route::get('/thanh-toan','CartController@pay');
Route::post('cart/store','CartController@store');
Route::get('cart/add/{id}','CartController@create');
Route::post('comment','CommentController@store');
Route::post('rating','HomeController@rate');
Route::post('them-vao-gio','CartController@add');
Route::get('yeu-thich','HomeController@wishList');
Route::get('add-single-item/{id}','CartController@addSingleItem');
Route::get('wishlist/delete/{id}','HomeController@wishDelete');
Route::get('lien-he','HomeController@contact');
Route::post('feedback','FeedbackController@store');

Route::get('thong-tin','HomeController@showProfile');
Route::get('trang/{slug}','HomeController@showPage');

Route::post('autocomplete','HomeController@autoComplete');
Route::get('tim-kiem','HomeController@search');

Route::get('tin-tuc','HomeController@showPosts');
Route::get('tin-tuc/{slug}','HomeController@showPost');
Route::get('phan-loai/{slug}','HomeController@showTaxonomy');
Route::get('danh-muc/{slug}','HomeController@showCategory');

Route::post('/like','HomeController@like');

Route::get('san-pham/{alias}','HomeController@showProduct');

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('auth/{provider}','Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback','Auth\LoginController@handleProviderCallback');

Route::post('change-payment-status', 'OrderController@changePaymentStatus');

Route::group(['prefix' => 'admin'], function () {
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/logout', 'AdminAuth\LoginController@logout');

  Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm');
  Route::post('/register', 'AdminAuth\RegisterController@register');

  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
});

Auth::routes();


