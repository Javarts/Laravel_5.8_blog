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

use App\Http\Controllers\CategoriesController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('categories', 'CategoriesController');
    
    Route::resource('tags', 'TagsController');

    Route::resource('posts', 'PostsController');

    Route::get('trashed-posts', 'PostsController@trashed')->name('trashed-posts.index');

    Route::put('retore-post/{post}', 'PostsController@restore')->name('restore-posts');
});