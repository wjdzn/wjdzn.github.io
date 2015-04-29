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
Route::get('login_from_forum', 'WelcomeController@login_for_forum');

Route::get('home', 'HomeController@index');

Route::get('cart', 'CartController@index');


Route::get('forum', function() {
    return Redirect::to('http://inventpalooza.com/forum/public/');
});

/* Admin Routes */
Route::get('admin',array('as' => 'admin', 'uses' => 'AdminController@index'));
Route::get('admin/calendar','AdminController@calendar');
Route::post('admin/calendar/events',array('as' => 'calendar_events', 'uses' => 'AdminController@events'));
Route::post('admin/calendar/save',array('as' => 'calendar_save_event', 'uses' => 'AdminController@save_event'));
Route::post('admin/calendar/update',array('as' => 'calendar_update_event', 'uses' => 'AdminController@update_event'));
Route::post('admin/calendar/delete',array('as' => 'calendar_delete_event', 'uses' => 'AdminController@delete_event'));

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
