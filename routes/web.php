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
    return view('welcome');
});

Auth::routes();




Route::group(['prefix' => 'admin', 'middleware' => 'auth' ],function()
		{

		Route::get('/home', [
			'uses' => 'HomeController@index',
			'as'	=> 'home'
		]);

		Route::get('/post/create', [

			'uses' => 'postController@create',
			'as' => 'post.create'
		]);

		Route::post('/post/store', [
			'uses' => 'postController@store',
			'as'	=> 'post.store'
		]);


});

