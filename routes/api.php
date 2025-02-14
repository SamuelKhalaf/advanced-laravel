<?php

use App\Http\Controllers\AdsController;
use App\Http\Controllers\Api\EmailController;
use App\Http\Controllers\Api\ExcelController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\ThirdPartyController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register' , [RegisterController::class , 'register']);
Route::post('login' , [RegisterController::class , 'login']);


Route::group(['middleware' => 'auth:sanctum'] , function (){
    Route::resource('/products' , ProductController::class);

    Route::get('/send_email' , [EmailController::class,'send']);
});

Route::get('export-excel' , [ExcelController::class , 'export']);
Route::post('import-excel' , [ExcelController::class , 'import']);

Route::post('get-api' , [ThirdPartyController::class , 'index']);

Route::get('/ads' , [AdsController::class,'ads']);

Route::get('/charts' , [MainController::class,'charts']);

Route::get('auth/google' , [SocialiteController::class,'redirectToGoogle']);
Route::get('auth/google/callback' , [SocialiteController::class,'handleGoogleCallback']);

Route::get('auth/facebook' , [SocialiteController::class,'redirectToFacebook']);
Route::get('auth/facebook/callback' , [SocialiteController::class,'handleFacebookCallback']);
