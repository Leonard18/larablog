<?php

use Illuminate\Support\Facades\Route;

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


//Pages route section... 
Route::get('/', 'PageController@getIndex')->name('pages.home');
Route::get('/about', 'PageController@getAbout')->name('pages.about');
Route::get('/contact', 'PageController@getContact')->name('pages.contact');
// Route::get('/search', 'PageController@getSearch')->name('pages.search');

//Post route... 
Route::resource('posts', 'PostController');

//Tag route...
Route::resource('tags', 'TagController');

//Comment route... 
Route::resource('comments', 'CommentController', ['except' => ['create']]);

//Category... 
Route::resource('categories', 'CategoryController');

//User route... 
Route::resource('users', 'UserController');

//Blog route section.... 
Route::get('/blog', 'BlogController@getIndex')->name('blog.index');
Route::get('/blog/{slug}', 'BlogController@getSingle')->where('slug', '[\w\d\-\_]+')->name('blog.single');
// Route::get('/blog/search/{slug}', 'BlogController@getSearch')->where('slug', '[\w\d\-\_]+')->name('blog.single');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
