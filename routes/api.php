<?php

use Illuminate\Http\Request;
// use App\Http\Controllers\TodosController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::get('users/ZmenaPozicie', 'UserController@zmenaPozicie');
// Route::get('http://localhost:8080/lar_skuska/public/users/ZmenaPozicie', 'UserController@zmenaPozicie');
// Route::post('http://localhost:8080/lar_skuska/public/todos', 'UserController@crateJS');
// Route::post('/todos', 'TodosController@storeJS');
// Route::post('/todos', 'TodosController@storeJS');
// Route::post('/users/ZmenaPozicie', 'UserController@zmenaPozicie');

// Route::get('/todos','TodosController');
// Route::prefix('todos')->group(
//     Route::post('/store', 'TodosController@store'),
//     Route::put('/{id}', 'TodosController@update'),
//     Route::delete('/{id}', 'TodosController@destroy')
// );



Route::post('posts', 'PostController@store');
Route::get('posts', 'PostController@get');
Route::delete('posts/{id}', 'PostController@delete');
