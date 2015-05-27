<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('main', 'MainController@index');
Route::get('/', 'WelcomeController@index');

Route::get('calendar', 'WelcomeController@calendar');
Route::post('calendar/events',array('as' => 'calendar_events_from_main', 'uses' => 'WelcomeController@events'));

Route::get('login_from_forum', 'WelcomeController@login_forum');
Route::get('update_from_forum', 'WelcomeController@update_from_forum');

Route::get('home', 'HomeController@index');

Route::get('cart', 'CartController@index');


Route::get('forum', function() {
    return Redirect::to('http://inventpalooza.com/forum/public/');
});
Route::get('forum_register', function() {
    return Redirect::to('http://inventpalooza.com/forum/public/register');
});
Route::get('forum_forgot_password', function() {
    return Redirect::to('http://inventpalooza.com/forum/public/forgot');
});
Route::get('login', function() {
    return view('login');
});

/* Admin Routes */
Route::get('admin',array('as' => 'admin', 'uses' => 'AdminController@index'));
Route::get('admin/calendar','AdminController@calendar');
Route::get('admin/users','AdminController@users');
Route::get('admin/products','AdminController@products');
/*Routes with calendar*/
Route::post('admin/calendar/events',array('as' => 'calendar_events', 'uses' => 'AdminController@events'));
Route::post('admin/calendar/save',array('as' => 'calendar_save_event', 'uses' => 'AdminController@save_event'));
Route::post('admin/calendar/update',array('as' => 'calendar_update_event', 'uses' => 'AdminController@update_event'));
Route::post('admin/calendar/delete',array('as' => 'calendar_delete_event', 'uses' => 'AdminController@delete_event'));
/*Routes with user*/
Route::get('admin/users/{id}/show',array('as' => 'user_show', 'uses' => 'AdminController@show_user'));
Route::get('admin/users/{id}/edit',array('as' => 'user_update', 'uses' => 'AdminController@update_user'));
Route::post('admin/users/{id}/edit',array('as' => 'user_update', 'uses' => 'AdminController@post_update_user'));
Route::get('admin/users/{email}/confirm_delete',array('as' => 'user_confirm_delete', 'uses' => 'AdminController@getModalDeleteUser'));
Route::get('admin/users/{email}/delete',array('as' => 'user_delete', 'uses' => 'AdminController@delete_user'));
Route::get('admin/users/{id}/change_password',array('as'=>'user_change_password','uses'=>'AdminController@change_password_user'));
/*Routes with products*/
Route::get('admin/products/new',array('as' => 'product_new', 'uses' => 'AdminController@new_product'));
Route::post('admin/products/new',array('as' => 'product_new', 'uses' => 'AdminController@save_product'));
Route::get('admin/products/{id}/confirm_delete',array('as' => 'product_confirm_delete', 'uses' => 'AdminController@getModalDeleteProduct'));
Route::get('admin/products/{id}/delete',array('as'=>'product_delete','uses' => 'AdminController@delete_product'));
Route::get('admin/products/{id}/show',array('as'=>'product_show','uses'=>'AdminController@show_product'));
Route::get('admin/products/{id}/edit',array('as' => 'product_update', 'uses' => 'AdminController@update_product'));
Route::post('admin/products/{id}/edit',array('as' => 'product_update', 'uses' => 'AdminController@post_update_product'));

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
