<?php

//Route::resource('/topics', 'TopicsController@show')->name('show');
/**
 * Home page
 */
Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/create_topic', 'App\Http\Controllers\HomeController@createTopic')->name('home.create_topic');
Route::post('/create_topic', 'App\Http\Controllers\HomeController@storeTopic')->name('home.store_topic');

Auth::routes();
/**
 * Admin Dashboard
 */
Route::get('/admin', 'App\Http\Controllers\Admin\DashboardController@index')->name('admin.dashboard'); 
Route::group([
  'prefix' => 'admin', 
  'namespace' => 'Admin',
  'as' => 'admin.'
], function(){
  
  Route::resource('forums', 'App\Http\Controllers\ForumsController',[
    'except' => ['show']
  ]);

  Route::resource('categories', 'App\Http\Controllers\CategoriesController',[
    'except' => ['show']
  ]);
});

/**
 * Forum pages
 */
Route::resource('forums', 'App\Http\Controllers\ForumsController',[
  'only' => 'show'
]);
Route::resource('forums.categories', 'App\Http\Controllers\CategoriesController', [
  'only' => 'show'
]);


/**
 * Topic And Comment Pages
 */
Route::resource('forums.categories.topics', 'App\Http\Controllers\TopicsController',[
  'only' => ['create', 'store']
]);
/*Route::resource('topics', 'App\Http\Controllers\TopicsController', [
  'only' => ['show', 'edit', 'update']
]);*/
Route::get('topics.show', 'App\Http\Controllers\TopicsController@show')->name('topics.show');
Route::get('topics.edit', 'App\Http\Controllers\TopicsController@edit')->name('topics.edit');
//Route::get('topics.update', 'TopicsController@update')->name('topics.update');
//Route::post('topics.update', 'TopicsController@update')->name('topics.update');
Route::post('/topics_update',  'App\Http\Controllers\TopicsController@update')->name('topics.update');
Route::get('/topics.comments.edit',  'App\Http\Controllers\CommentsController@edit')->name('comments.edit');
Route::post('comments.update',  'App\Http\Controllers\CommentsController@update')->name('comments.update');


Route::resource('topics.comments', 'App\Http\Controllers\CommentsController',[
  'except' => ['index', 'show', 'destroy']
]);



/**
 * Profile pages
 */
Auth::routes();
Route::get('/profile/password', 'App\Http\Controllers\ProfileController@editPassword')->name('profile.edit_password');
Route::post('/profile/password', 'App\Http\Controllers\ProfileController@updatePassword')->name('profile.update_password');
Route::get('/profile/edit', 'App\Http\Controllers\ProfileController@edit')->name('profile.edit');
Route::patch('/profile/update', 'App\Http\Controllers\ProfileController@update')->name('profile.update');

/**
 * Message pages
 */
Route::get('/profile/message', 'App\Http\Controllers\MessageController@index')->name('profile.message.index');
Route::resource('profile.message', 'App\Http\Controllers\MessageController', [
  'except' => ['index','edit','destroy']
]);
Route::get('/profile/{id}', 'App\Http\Controllers\ProfileController@show')->name('profile.show');


