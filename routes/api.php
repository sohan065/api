<?php

use App\Http\Controllers\ApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// get method for showing all data 
Route::get('/users/{id?}', [ApiController::class, 'index']);

// post method for adding single user 
Route::post('/add-user', [ApiController::class, 'store']);

// post method for adding multiple user 
Route::post('/add-multiple-user', [ApiController::class, 'addMultipleUser']);

//put method for updating user information
Route::PUT('/update-user/{id}', [ApiController::class, 'updateUser']);

//patch method for updating user information
Route::patch('/update-user-single-data/{id}', [ApiController::class, 'updateUserSingleData']);

//delete method for delete single user by id

Route::delete('/delete/{id}', [ApiController::class, 'delete']);

//delete method for delete single user by json

Route::delete('/delete-by-json', [ApiController::class, 'deleteByJson']);


// delete method for delete multiple user by json

Route::delete('/delete-multiple-user-by-json', [ApiController::class, 'multipleUserDeleteByJson']);
