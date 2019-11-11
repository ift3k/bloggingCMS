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

//Mailchimp subscription

Route::post('/subscribe', function(){
	$email = request('email');

	Newsletter::subscribe($email);
	Session::flash('subscribed','Successfully subscribed.');
	return redirect()->back();
});

Route::get('/test', function() {
	return App\User::find(1)->profile;
});

Route::get('/', [
	'uses' => 'FrontEndController@index',
	'as'   => 'index'
]);

Route::get('/results', function(){

	$posts = \App\Post::where('title','like', '%' . request('query') . '%' )->get();

	return view('results')->with('posts', $posts)
						  ->with('title', 'Search Results: ' .  request('query'))
			   			  ->with('settings', \App\Setting::first())
    		  			  ->with('catagories', \App\Catagory::take(10)->get())
    		  			  ->with('query', request('query'));


});


Route::get('/post/{slug}', [
			'uses'	=> 'FrontEndController@singlePost',
			'as'	=> 'post.single'
		]);


Route::get('/catagory/{id}', [
	'uses' => 'FrontEndController@catagory',
	'as'	=> 'catagory.single'
]);

Route::get('/tag/{id}', [
	'uses' => 'FrontEndController@tag',
	'as'	=> 'tag.single'
]);

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


		Route::get('/tag', [
			'uses' => 'TagController@index',
			'as'  => 'tags'
		]);

		Route::get('/tag/edit/{id}', [
			'uses' => 'TagController@edit',
			'as'	=> 'tag.edit'
		]);

		Route::get('/tag/create', [
			'uses' => 'TagController@create',
			'as'	=> 'tag.create'
		]);

		Route::post('/tag/store', [
			'uses' => 'TagController@store',
			'as'	=> 'tag.store'
		]);


		Route::post('tag/update/{id}', [
			'uses' => 'TagController@update',
			'as' => 'tag.update'
		]);

		Route::get('/tag/delete/{id}', [
			'uses' => 'TagController@delete',
			'as' => 'tag.delete'
		]);

		Route::get('/users', [
			'uses'	=> 'UsersController@index',
			'as'	=> 'users'
		]);

		Route::get('/user/create', [
			'uses'	=> 'UsersController@create',
			'as'	=> 'user.create'
		]);

		Route::post('/user/store', [
			'uses'	=> 'UsersController@store',
			'as'	=> 'user.store'
		]);

		Route::get('/user/admin/{id}', [
			'uses' => 'UsersController@admin',
			'as'   => 'user.admin'
		]);

		Route::get('user/not-admin/{id}', [
			'uses'	=> 'UsersController@not_admin',
			'as'	=> 'user.not.admin'
		]);

		Route::get('user/profile', [
			'uses' => 'ProfilesController@index',
			'as'   => 'user.profile'
		]);
		

		Route::post('user/profile/update', [
			'uses'	=> 'ProfilesController@update',
			'as'	=> 'user.profile.update'
		]);

		Route::get('user/delete/{id}', [
			'uses'	=> 'UsersController@destroy',
			'as'	=> 'user.delete'
		]);

		Route::get('/settings', [
			'uses' => 'SettingsController@index',
			'as'   => 'settings'
		]);


		Route::post('/settings/update', [
			'uses'	=> 'SettingsController@update',
			'as'	=> 'settings.update'
		]);

		
});

