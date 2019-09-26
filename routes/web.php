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

		Route::get('/catagory/create', [
			'uses' => 'CatagoriesController@create',
			'as'	=> 'catagory.create'
		]);

		Route::get('/catagories', [
			'uses' => 'CatagoriesController@index',
			'as'	=> 'catagories'
		]);

		Route::post('/catagory/store', [
			'uses' => 'CatagoriesController@store',
			'as' => 'catagory.store'
		]);

		Route::get('/catagory/edit/{id}', [
			'uses' => 'CatagoriesController@edit',
			'as'	=> 'catagory.edit'
		]);

		Route::get('/catagory/delete/{id}', [
			'uses' => 'CatagoriesController@destroy',
			'as'	=> 'catagory.delete'
		]);

		Route::post('/catagory/update/{id}', [
			'uses' => 'CatagoriesController@update',
			'as'	=> 'catagory.update'
		]);

		Route::get('/posts',[
			'uses' => 'postController@index',
			'as'	=> 'posts'
		]);

		Route::get('/posts/delete/{id}',[
			'uses' => 'postController@destroy',
			'as'	=> 'post.delete'
		]);

		Route::get('/posts/edit/{id}', [
			'uses'	=> 'postController@edit',
			'as'	=> 'post.edit'
		]);

		Route::post('/posts/update/{id}',[
			'uses'	=>	'postController@update',
			'as'	=>	'post.update'
		]);


		Route::get('/posts/trashed',[
			'uses' => 'postController@trashed',
			'as' => 'post.trashed'
		]);

		Route::get('/posts/kill/{id}', [
			'uses'	=>	'postController@kill',
			'as'	=>	'post.kill'
		]);

		Route::get('/posts/restore/{id}', [
			'uses'	=> 'postController@restore',
			'as'	=> 'post.restore'
		]);

});

