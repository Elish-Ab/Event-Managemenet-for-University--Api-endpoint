<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\RegistrationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//this line is protected
Route::group(['middleware'=>['auth:sanctum']], function () {

    //protected features from non-registered users/not signedUp

            //logout api
        Route::get('logout', [AuthController::class, 'logout']);


            //registration api
        Route::get('registration', [RegistrationController::class,'index']);
        Route::post('registration/create', [RegistrationController::class,'store']);
        Route::put('registration/update', [RegistrationController::class,'update']);
        Route::delete('registration/delete/{id?}', [RegistrationController::class,'delete']);


        //Comment api
        Route::get('comment', [CommentController::class,'index']);
        Route::post('comment/create', [CommentController::class,'store']);
        Route::put('comment/update', [CommentController::class,'update']);
        Route::delete('comment/delete/{id?}', [CommentController::class,'delete']);


   
    
});


//signup api
Route::post('signup', [AuthController::class, 'SignUp']);
Route::post('login', [AuthController::class, 'login']);



//user api
Route::get('user',[UserController::class,'index']);
Route::get('user/{id?}',[UserController::class,'show']);
Route::get('user/comment/{id?}',[UserController::class,'comment']);
Route::get('user/event/{id?}',[UserController::class,'event']);
Route::post('user/create', [UserController::class, 'store']);
Route::put('user/update', [UserController::class, 'update']);
Route::delete('user/delete/{id?}', [UserController::class, 'delete']);


//role api
Route::get('role',[RoleController::class,'index']);
Route::post('role/create', [RoleController::class, 'store']);
Route::put('role/update', [RoleController::class, 'update']);
Route::delete('role/delete/{id?}', [RoleController::class, 'delete']);

//event api
Route::get('event',[EventController::class,'index']);
Route::post('event/create/', [EventController::class, 'store']);
Route::put('event/update',[EventController::class, 'update']);
Route::delete('event/delete/{id?}',[EventController::class, 'delete']);


//feedback api
Route::get('feedback', [FeedbackController::class,'index']);
Route::post('feedback/create', [FeedbackController::class,'store']);
Route::put('feedback/update', [FeedbackController::class,'update']);
Route::delete('feedback/delete/{id?}', [FeedbackController::class,'delete']);

