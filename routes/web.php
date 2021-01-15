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

// Route::get('/', function () {
//     return view('todo');
// });


Route::get('/', 'PagesController@index');
Route::get('/todo', 'PagesController@todo');
Route::get('/create', 'PagesController@create');
Route::get('/contact', 'PagesController@contact');

Route::resource('todos','TodosController');
Route::resource('users','UserController');
Route::resource('oddelenie','OddelenieController');
Route::resource('zaradenie','ZaradenieController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
