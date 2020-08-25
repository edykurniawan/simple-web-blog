<?php

use Illuminate\Support\Facades\Route;
use PhpParser\Node\Stmt\Return_;
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


Route::get('/', 'HomeController@index')->name('home');

Route::get('/blogs', 'BlogController@index')->name('blogs');
Route::get('/blog/create', 'BlogController@create')->middleware('auth');
Route::post('/blogs', 'BlogController@store');
Route::get('/blog/{slug}', 'BlogController@show')->name('show');
Route::get('/blog/{id}/edit', 'BlogController@edit')->middleware('auth');
Route::put('/blog/{id}', 'BlogController@update')->middleware('auth');
Route::delete('/blog/{id}', 'BlogController@destroy')->name('delete')->middleware('auth');

Route::get('/blogs/filter/{tag}', 'BlogController@filter');
Auth::routes(['register' => false]);
