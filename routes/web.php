<?php

use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\GraduationController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\SkillController;
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
Route::get('/' , [UserController::class,'showCorrectPage'])->name('login');
//register the user
Route::post('/register-user', [UserController::class,'registerUser'])->middleware('guest');

//singout the user
Route::post('/signout-user', [UserController::class,'signoutUser'])->middleware('auth');

//log in the user
Route::get('/login-form', [UserController::class,'loginUserForm'])->middleware('guest');

//logging in the user
Route::post('/login-user', [UserController::class,'loginUser'])->middleware('guest');

//showing personal data createCV form
Route::get('/create-cv-form/{user}/personal', [PersonalController::class,'showPersonalCVForm'])->middleware('auth');

//save personal info and go next step
Route::post('/create-cv-form/{user}/personal/information', [PersonalController::class,'getPersonalCV'])->middleware('auth');

//showing skills form
Route::get('/create-cv-form/{user}/skills', [SkillController::class,'showSkillsCVForm'])->middleware('auth');

//save skill info and go next step
Route::post('/create-cv-form/{user}/skills/information', [SkillController::class,'getSkillCV'])->middleware('auth');

// showing the experience form
Route::get('/create-cv-form/{user}/work-experience', [ExperienceController::class,'showWorkExpCVForm'])->middleware('auth');

//save experience info and go next step
Route::post('/create-cv-form/{user}/work-experience/information', [ExperienceController::class,'getWorkExpCV'])->middleware('auth');

//showing the graduation form 
Route::get('/create-cv-form/{user}/graduation', [GraduationController::class,'showGraduationCVForm'])->middleware('auth');

//save graduation form data info and next step
Route::post('/create-cv-form/{user}/graduation/information', [GraduationController::class,'getGraduationCV'])->middleware('auth');

//choose template for the resume
Route::get('/choose-template/{user}/resume', [UserController::class,'showTemplates'])->middleware('auth');

//see first template 
Route::get('/first-template/{user}', [UserController::class,'showFirstTemplate'])->middleware('auth');

//see second template 
Route::get('/second-template/{user}', [UserController::class,'showSecondTemplate'])->middleware('auth');

//see third template 
Route::get('/third-template/{user}', [UserController::class,'showThirdTemplate'])->middleware('auth');

//see fourth template 
Route::get('/fourth-template/{user}', [UserController::class,'showFourthTemplate'])->middleware('auth');

//show the user resume
Route::get('/show-resume/{user}', [UserController::class,'showResume'])->middleware('auth');

//show change setting list
Route::get('/change-profile/{user}', [UserController::class,'showProfilePage'])->middleware('auth');

//show changing user info form
Route::get('/create-cv-form/{user}/edit/user', [UserController::class,'showChangeUserInfo'])->middleware('auth');

//save the user edit settings
Route::post('/create-cv-form/{user}/edit/user/save', [UserController::class,'saveUserChanging'])->middleware('auth');

//show chnging personal info form
Route::get('/create-cv-form/{user}/edit/personal', [PersonalController::class,'showChangePersonalInfo'])->middleware('auth');

//save the personal edit settings
Route::post('/create-cv-form/{user}/edit/personal/save', [PersonalController::class,'savePersonalChanging'])->middleware('auth');

//show chnging skill info form
Route::get('/create-cv-form/{user}/edit/skill', [SkillController::class,'showChangeSkillInfo'])->middleware('auth');

//save the skill edit settings
Route::post('/create-cv-form/{user}/edit/skill/save', [SkillController::class,'saveSkillChanging'])->middleware('auth');

//show chnging graduation info form
Route::get('/create-cv-form/{user}/edit/graduation', [GraduationController::class,'showChangeGraduationInfo'])->middleware('auth');

//save the graduation edit settings
Route::post('/create-cv-form/{user}/edit/graduation/save', [GraduationController::class,'saveGraduationChanging'])->middleware('auth');

//show changing experience form
Route::get('/create-cv-form/{user}/edit/experience', [ExperienceController::class,'showChangeExperienceInfo'])->middleware('auth');

//save the experience edit settings
Route::post('/create-cv-form/{user}/edit/experience/save', [ExperienceController::class,'saveExperienceChanging'])->middleware('auth');

//show changing template form
Route::get('/create-cv-form/{user}/edit/template', [UserController::class,'showChangeTemplateInfo'])->middleware('auth');

//show changing password form
Route::get('/create-cv-form/{user}/edit/password', [UserController::class,'showChangePasswordInfo'])->middleware('auth');

//save the password edit settings
Route::post('/create-cv-form/{user}/edit/password/save', [UserController::class,'savePasswordChanging'])->middleware('auth');

//see the forgetting password
Route::get('/forget-password', [UserController::class,'showForgetPassPage'])->middleware('guest');

//change forget password
Route::post('/forget-password/save', [UserController::class,'changeTheForgetPassword'])->middleware('guest');

//delete skills
Route::delete('/delete-skill/{skill}/{user}', [SkillController::class,'deleteSkills'])->middleware('auth');

//delete skill in change mode skills
Route::delete('/delete-skill/{skill}/{user}/change', [SkillController::class,'deleteSkillsChange'])->middleware('auth');

//edit skills form
Route::get('/edit-skill/{skill}/{user}', [SkillController::class,'updateSkillsForm'])->middleware('auth');

//save edit skills
Route::post('/edit-skill/{skill}/{user}/save', [SkillController::class,'saveUpdateSkills'])->middleware('auth');


//edit skills in change mode form
Route::get('/edit-skill/{skill}/{user}/change', [SkillController::class,'updateSkillsFormCahnge'])->middleware('auth');

//save edit in change mode skills
Route::post('/edit-skill/{skill}/{user}/change/save', [SkillController::class,'saveUpdateSkillsChange'])->middleware('auth');




//graduation relational

//delete graduations
Route::delete('/delete-graduation/{graduation}/{user}', [GraduationController::class,'deleteGraduation'])->middleware('auth');

//delete graduation in change mode graduations
Route::delete('/delete-graduation/{graduation}/{user}/change', [GraduationController::class,'deleteGraduationChange'])->middleware('auth');

//edit graduation form
Route::get('/edit-graduation/{graduation}/{user}', [GraduationController::class,'updateGraduationForm'])->middleware('auth');

//save edit graduation
Route::post('/edit-graduation/{graduation}/{user}/save', [GraduationController::class,'saveUpdateGraduation'])->middleware('auth');


//edit graduation in change mode form
Route::get('/edit-graduation/{graduation}/{user}/change', [GraduationController::class,'updateGraduationFormCahnge'])->middleware('auth');

//save edit in change mode graduation
Route::post('/edit-graduation/{graduation}/{user}/change/save', [GraduationController::class,'saveUpdateGraduationChange'])->middleware('auth');





