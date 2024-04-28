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
Route::post('/create-cv-form/{user}/work-experience', [UserController::class,'showWorkExpCVForm']);

//save experience info and go next step
Route::post('/create-cv-form/{user}/work-experience/information', [UserController::class,'getWorkExpCV']);

//showing the graduation form 
Route::get('/create-cv-form/{user}/graduation', [UserController::class,'showGraduationCVForm']);

//save graduation form data info and next step
Route::post('/create-cv-form/{user}/graduation/information', [UserController::class,'getGraduationCV']);

//choose template for the resume
Route::get('/choose-template/{user}/resume', [UserController::class,'showTemplates']);

//see first template 
Route::get('/first-template/{user}', [UserController::class,'showFirstTemplate']);

//see second template 
Route::get('/second-template/{user}', [UserController::class,'showSecondTemplate']);

//see third template 
Route::get('/third-template/{user}', [UserController::class,'showThirdTemplate']);

//see fourth template 
Route::get('/fourth-template/{user}', [UserController::class,'showFourthTemplate']);

//show the user resume
Route::get('/show-resume/{user}', [UserController::class,'showResume']);

//show change setting list
Route::get('/change-profile/{user}', [UserController::class,'showProfilePage']);

//show changing user info form
Route::get('/create-cv-form/{user}/edit/user', [UserController::class,'showChangeUserInfo']);

//save the user edit settings
Route::post('/create-cv-form/{user}/edit/user/save', [UserController::class,'saveUserChanging']);

//show chnging personal info form
Route::get('/create-cv-form/{user}/edit/personal', [UserController::class,'showChangePersonalInfo']);

//save the personal edit settings
Route::post('/create-cv-form/{user}/edit/personal/save', [UserController::class,'savePersonalChanging']);

//show chnging skill info form
Route::get('/create-cv-form/{user}/edit/skill', [UserController::class,'showChangeSkillInfo']);

//save the skill edit settings
Route::post('/create-cv-form/{user}/edit/skill/save', [UserController::class,'saveSkillChanging']);

//show chnging graduation info form
Route::get('/create-cv-form/{user}/edit/graduation', [UserController::class,'showChangeGraduationInfo']);

//save the graduation edit settings
Route::post('/create-cv-form/{user}/edit/graduation/save', [UserController::class,'saveGraduationChanging']);

//show changing experience form
Route::get('/create-cv-form/{user}/edit/experience', [UserController::class,'showChangeExperienceInfo']);

//save the experience edit settings
Route::post('/create-cv-form/{user}/edit/experience/save', [UserController::class,'saveExperienceChanging']);

//show changing template form
Route::get('/create-cv-form/{user}/edit/template', [UserController::class,'showChangeTemplateInfo']);

//show changing password form
Route::get('/create-cv-form/{user}/edit/password', [UserController::class,'showChangePasswordInfo']);

//save the password edit settings
Route::post('/create-cv-form/{user}/edit/password/save', [UserController::class,'savePasswordChanging']);

//see the forgetting password
Route::get('/forget-password', [UserController::class,'showForgetPassPage']);

//change forget password
Route::post('/forget-password/{user}/save', [UserController::class,'changeTheForgetPassword']);










