<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

//admin
Route::middleware('auth')
->namespace('Admin')
->name('admin.')
->prefix('admin') 
->group(function() {
    
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::resource('products', 'ProductController');
    Route::resource('anime', 'AnimeController')->except('show');
    Route::resource('seasons', 'SeasonController')->except('show');
    Route::resource('categories', 'CategoryController')->except('show');
});

Route::get('{any?}', 'HomeController@index')->where('any', '.*')->name('home');
