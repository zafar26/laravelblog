<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

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
//     return view('');
// });

// All Listings
Route::get('/', [ListingController::class, 'index']);


// Show Create Form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// Store Listing Data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// Show Edit Form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

// Update Listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

// Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

// Manage Listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

// Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);

// Show Register/Create Form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Create New User
Route::post('/users', [UserController::class, 'store']);

// Log User Out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Log In User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);



// Create Comment
Route::post('/comment', [CommentController::class, 'create']);

// Show Edit Comment 
Route::get('/listing/{listing}/comment/edit/{comment}', [ListingController::class, 'editComment']);

// Update Comment  
Route::put('/comment/{comment}', [CommentController::class, 'update']);

// Delete Comment
Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->middleware('auth');




Route::get('google',function(){return view('googleAuth');});
    
Route::get('auth/google', 'Auth\LoginController@redirectToGoogle');

Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback');