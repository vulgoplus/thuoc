<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('admin')->user();

    //dd($users);

    return redirect()->to('admin');
})->name('home');

Route::get('/', 'DashboardController@index');

Route::resource('categories','CategoryController');
Route::post('categories/destroy','CategoryController@delete');
Route::post('categories/add','CategoryController@add');

Route::resource('products','ProductController');
Route::post('products/delete','ProductController@delete');
Route::post('products/slug','ProductController@createSlug');
Route::post('/products/featured/{id}','ProductController@featured');
Route::post('products/filter','ProductController@filter');

Route::resource('pages','PageController');
Route::post('pages/delete','PageController@delete');

Route::resource('posts','PostController');
Route::post('posts/slug','PostController@createSlug');
Route::post('posts/featured/{id}','PostController@featured');

Route::resource('taxonomies','TaxonomyController');
Route::post('taxonomies/delete','TaxonomyController@delete');
Route::post('taxonomies/add','TaxonomyController@add');

Route::resource('users','UserController');
Route::post('change-password','UserController@changePassword');
Route::post('charge','UserController@incrementBalance');

Route::resource('sliders','SliderController');
Route::post('sliders/store-image','SliderController@storeImage');
Route::get('sliders/delete/{id}','SliderController@deleteImage');
Route::post('sliders/update-image','SliderController@updateImage');

Route::resource('admins','AdminController');
Route::post('admins/change-password','AdminController@changePassword');

Route::resource('comments','CommentController');
Route::post('comments/destroy','CommentController@delete');

Route::get('orders','OrderController@index');
Route::post('orders/change-status', 'OrderController@changeStatus');
Route::get('orders/{id}','OrderController@show');
Route::post('orders/delete','OrderController@delete');
Route::post('orders/filter','OrderController@filter');
Route::delete('orders/{id}','OrderController@destroy');

Route::get('chart','DashboardController@chart');

Route::get('feedback','FeedbackController@index');
Route::post('feedback/destroy','FeedbackController@delete');
Route::delete('feedback/{id}','FeedbackController@destroy');
