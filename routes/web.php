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
Route::get('oddelenie/{id}/removeUser', 'OddelenieController@removeUser');

Route::post('users/ZmenaPozicie', 'UserController@zmenaPozicie');
Route::post('todos/ZmenaProgresu', 'TodosController@zmenaProgresu');


// Route::delete('todos/DeleteJS', 'TodosController@DeleteJS');
Route::delete('todos/{id}/DeleteJS', 'TodosController@DeleteJS');


// Route::get('http://localhost:8080/lar_skuska/public/users/ZmenaPozicie', 'UserController@zmenaPozicie');
// Route::post('/users/ZmenaPozicie', 'UserController@zmenaPozicie');
// Route::post('/todo', 'TODOController@store');

// Route::post('/todos/storeJS','TodosController@storeJS');
Route::get('/todos/storeJS','TodosController@storeJS');
// Route::post('/todos', 'TodosController@storeJS');
Route::post('/todosCreate', 'RestController@storeTodoJs');

Route::resource('todos','TodosController');
Route::resource('users','UserController');
Route::resource('oddelenie','OddelenieController');
Route::resource('zaradenie','ZaradenieController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/posts', 'PostController@index');