<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ListingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// For all listings
Route::get('/', [ListingController::class, 'index']); 

// Show Create Listing
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// Store Listing
Route::post('/listings', [ListingController::class, 'store']);
// Single Listing
// if we are using the eloquent model for this one we use the this method to set out like an listing



// Show Edit Form
Route::get('listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

// Edit update form
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

// Delete Listing Record
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');
// Manage Listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

// Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);

// Show Users/ Create Users
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Create New User
Route::post('/users', [UserController::class, 'store']);

// Log User Out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Login User Route
Route::post('/users/authenticate', [UserController::class, 'authenticate']);



// Custom route to test // with the response helper to test
// Route::get('/hello', function(){
//     return response('<h1>Hello World</h1>', 200)
//     ->header('Content-Type', 'text/plain')
//     ->header('foo', 'bar');     // set custom header
// });
// Route the with the wild card with custom Route
// Route::get('/posts/{id}', function($id){     // always we use the numbers not strings like that for this one we use the regualar expression
//     // dd($id);  die debug
//     return response('Posts '. $id);
// })->where('id', '[0-9]+');
// for the search query string
// Route::get('/search', function(Request $Request){
//     return $Request->name. ' ' .$Request->city;   // for the levearage this way to use; in this way we use search query paremeter;
// });
// Route::get('/blogPosts', [PostsController::class, 'index']);