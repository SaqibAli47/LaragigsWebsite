<?php

use App\Http\Controllers\PostsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// let's create an custom Api for the requirment basically all these are in the controller so for test purpose to use this one 
Route::get('/posts', function(){
    return response()->json([
        'posts' => [
            [
                'title' => 'Post One'
            ]
        ]
    ]);
});
// Route::get('/blogsPosts',[PostsController::class, 'index']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
