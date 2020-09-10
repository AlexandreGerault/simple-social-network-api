<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('guest:sanctum')->post('/login', 'Auth\LoginController');
Route::middleware('auth:sanctum')->get('/logout', 'Auth\LogoutController');
Route::middleware('guest:sanctum')->post('/register', 'Auth\RegisterController');

Route::middleware('auth:sanctum')->patch('/users/{id}', 'Profile\EditProfileController');
Route::get('/users/search', 'Users\SearchUserController');

Route::middleware('auth:sanctum')->put('/posts/{id}', 'Post\EditPostController');
Route::middleware('auth:sanctum')->delete('/posts/{id}', 'Post\DeletePostController');
Route::middleware('auth:sanctum')->post('/posts', 'Post\CreatePostController');
