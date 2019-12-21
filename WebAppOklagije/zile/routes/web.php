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

// rute za korisnicki deo

//prikaz stranica
Route::get('/', 'FrontendController@index')->name('home');
Route::get('/news', 'FrontendController@news');
Route::get('/contact', 'FrontendController@contact');
Route::get('/products', 'FrontendController@products');
Route::get('/product/{id}', 'FrontendController@product');
Route::get('/cart', 'FrontendController@cart');

//slanje poruka
Route::post('/sendmessage', 'MessageController@send');

/* samo za registrovane korisnike */
Route::group(['middleware' => 'user'], function(){
	//dodavanje komentara ulogovanog korisnika na proizvod
	Route::post('/comment', 'CommentController@comment');

	//slanje utisaka korisnika
	Route::post('/feedback', 'FeedbackController@send');
});


//registracija i logovanje i odjavu korisnika
Route::post('/login', 'UserController@login');
Route::post('/registration', 'UserController@registration');
Route::get('/logout', 'UserController@logout');

//ajax rute
Route::get('/paginationNews', 'AjaxController@paginationNews');
Route::get('/paginationProducts', 'AjaxController@paginationProducts');
Route::get('/filter', 'AjaxController@filter');
Route::get('/paginationFilter', 'AjaxController@paginationFilter');
Route::get('/filterAll', 'AjaxController@filterAll');
Route::get('/sort', 'AjaxController@sort');
Route::get('/rate', 'AjaxController@rate');
Route::get('/order', 'OrderController@order');

/* samo za administratora */
Route::group(['middleware' => 'admin'], function(){
	//rute za administratora
	Route::get('/admin/home', 'AdminController@index')->name('admin');
	Route::get('/admin/order', 'AdminController@order');
	Route::get('/admin/order/delete/{id}', 'AdminController@orderDelete');
	Route::get('/admin/inbox', 'AdminController@inbox');
	Route::get('/admin/message/{id}', 'AdminController@message');
	Route::get('/admin/deleteMessage/{id}', 'AdminController@deleteMessage');
	Route::get('/admin/notify/{id?}', 'AdminController@notify');
	Route::get('/admin/commNot', 'AdminController@commNoti');
	Route::get('/admin/feedNot', 'AdminController@feedNoti');
	Route::get('/admin/orderNot', 'AdminController@orderNoti');
	Route::get('/admin/feed', 'AdminController@feedback');
	Route::get('/admin/feed/update/{id}', 'AdminController@feedUpdate');
	Route::get('/admin/feed/cancle/{id}', 'AdminController@feedCancle');
	Route::get('/admin/feed/delete/{id}', 'AdminController@feedDelete');
	Route::get('/admin/comment', 'AdminController@comment');
	Route::get('/admin/comment/answer/{id}', 'AdminController@answer');
	Route::post('/answer/send', 'AdminController@sendAnswer');
	Route::get('/admin/comment/delete/{id}', 'AdminController@commentDelete');
	Route::get('/admin/users', 'AdminController@users');
	Route::get('/admin/newPassword/{id}', 'AdminController@newPassword');
	Route::post('/admin/resetPassword', 'AdminController@resetPassword');
	Route::get('/admin/action', 'AdminController@action');
	Route::get('admin/action/delete/{id}', 'AdminController@deleteAction');
	Route::get('/admin/newAction', 'AdminController@newAction');
	Route::post('/action/insert', 'AdminController@insertAction');
	Route::get('/admin/action/add/{id}', 'AdminController@addProductsInAction');
	Route::post('/action/addProducts/{id}', 'AdminController@addProducts');
	Route::get('/admin/news', 'AdminController@adminNews');
	Route::get('/admin/news/add', 'AdminController@addNews');
	Route::post('/news/insert', 'AdminController@insertNews');
	Route::get('/admin/news/delete/{id}', 'AdminController@deleteNews');
	Route::get('admin/news/update/{id}', 'AdminController@topNews');
	Route::post('/news/updateStatus/{id}', 'AdminController@updateStatus');
	Route::get('/admin/category', 'AdminController@category');
	Route::get('admin/newCategory', 'AdminController@newCategory');
	Route::get('admin/category/delete/{id}', 'AdminController@deleteCategory');
	Route::post('/category/insert', 'AdminController@insertCategory');
	Route::get('/admin/slider', 'AdminController@slider');
	Route::get('admin/slider/delete/{id}', 'AdminController@deleteSlider');
	Route::get('admin/newSlider', 'AdminController@newSlider');
	Route::post('/slider/insert', 'AdminController@insertSlider');
	Route::get('/admin/products', 'AdminController@products');
	Route::get('admin/newProduct', 'AdminController@newProduct');
	Route::post('/products/insert', 'AdminController@insertProduct');
	Route::get('admin/products/delete/{id}', 'AdminController@deleteProduct');
	Route::get('admin/products/view/{id}', 'AdminController@view');
	Route::get('admin/updateProduct/{id}', 'AdminController@update');
	Route::post('/products/update/{id}', 'AdminController@upProd');
	Route::get('/admin/note/{id}', 'AdminController@note');
	Route::post('/note/insert/{id}', 'AdminController@insertNote');
	Route::get('admin/noteDelete/{id}', 'AdminController@deleteNote');
});

//ajax rute administratora
Route::get('/pushNot', 'AdminController@ajax');
Route::get('/status', 'AdminController@status');
Route::get('/paginationOrder', 'AdminController@paginationOrder');

