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

//save personal info and go next step
Route::post('/create-cv-form/{user}/personal/information', [UserController::class,'getPersonalCV']);

//showing skills form
Route::get('/create-cv-form/{user}/skills', [UserController::class,'showSkillsCVForm']);

//save skill info and go next step
Route::post('/create-cv-form/{user}/skills/information', [UserController::class,'getSkillCV']);

// showing the experience form
Route::post('/create-cv-form/{user}/work-experience/information', [UserController::class,'showWorkExpCVForm']);

//save experience info and go next step
Route::post('/create-cv-form/{user}/work-experience/information', [UserController::class,'getWorkExpCV']);

//showing the graduation form 
Route::get('/create-cv-form/{user}/graduation', [UserController::class,'showGraduationCVForm']);

//save graduation form data info and next step
Route::post('/create-cv-form/{user}/graduation/information', [UserController::class,'getGraduationCV']);

//choose template for the resume
Route::get('/choose-template/{user}/resume', [UserController::class,'showTemplates']);

//see first template 
Route::get('/first-template/{user}/{personal}/{skill}/{experience}/{graduation}', [UserController::class,'showFirstTemplate']);








