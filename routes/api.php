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
        Route::prefix('registration')->group(function(){
                Route::get('/', [RegistrationController::class,'index']);
                Route::post('/create', [RegistrationController::class,'store']);
                Route::put('/update', [RegistrationController::class,'update']);
                Route::delete('/delete/{id?}', [RegistrationController::class,'delete']);     
        });
       


        //Comment api
        Route::prefix('comment')->group(function(){
              Route::get('/', [CommentController::class,'index']);
              Route::post('/create', [CommentController::class,'store']);
              Route::put('/update', [CommentController::class,'update']);
              Route::delete('/delete/{id?}', [CommentController::class,'delete']);  
        });
        


   
    
});


//signup api
Route::post('signup', [AuthController::class, 'SignUp']);
Route::post('login', [AuthController::class, 'login']);



//user api
Route::prefix('user')->group(function(){
    Route::get('/',[UserController::class,'index']);
    Route::get('/{id?}',[UserController::class,'show']);
    Route::get('/comment/{id?}',[UserController::class,'comment']);
    Route::get('/event/{id?}',[UserController::class,'event']);
    Route::post('/create', [UserController::class, 'store']);
    Route::put('/update', [UserController::class, 'update']);
    Route::delete('/delete/{id?}', [UserController::class, 'delete']);
});

//role api\
Route::prefix('role')->group(function(){
    Route::get('/',[RoleController::class,'index']);
    Route::post('/create', [RoleController::class, 'store']);
    Route::put('/update', [RoleController::class, 'update']);
    Route::delete('/delete/{id?}', [RoleController::class, 'delete']);
});
//event api
Route::prefix('event')->group(function(){
    Route::get('/',[EventController::class,'index']);
    Route::post('/create/', [EventController::class, 'store']);
    Route::put('/update',[EventController::class, 'update']);
    Route::delete('/delete/{id?}',[EventController::class, 'delete']);
});


//feedback api
Route::prefix('feedback')->group(function(){
   Route::get('/', [FeedbackController::class,'index']);
    Route::post('/create', [FeedbackController::class,'store']);
    Route::put('/update', [FeedbackController::class,'update']);
    Route::delete('/delete/{id?}', [FeedbackController::class,'delete']); 
});


