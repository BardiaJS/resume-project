<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
//showing the first page
Route::get('/' , [UserController::class,'showCorrectPage']);
//register the user
Route::post('/register-user', [UserController::class,'registerUser']);

//singout the user
Route::post('/signout-user', [UserController::class,'signoutUser']);

//log in the user
Route::get('/login-form', [UserController::class,'loginUserForm']);

//logging in the user
Route::post('/login-user', [UserController::class,'loginUser']);

//showing personal data createCV form
Route::get('/create-cv-form/{user}/personal', [UserController::class,'showPersonalCVForm']);
Route::post('/create-cv-form/{user}/skills', [UserController::class,'getPersonalCV']);


