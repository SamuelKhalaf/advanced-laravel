<?php

use App\Http\Controllers\AdsController;
use App\Http\Controllers\Api\EmailController;
use App\Http\Controllers\Api\ExcelController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\QueuedJobsController;
use App\Http\Controllers\SmsController;
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
    Route::get('/products' , [ProductController::class,'index'])->middleware('can:viewAny,App\Models\Product');
    Route::get('/products/create' , [ProductController::class,'create'])->middleware('can:create,App\Models\Product');
    Route::post('/products/store' , [ProductController::class,'store'])->middleware('can:create,App\Models\Product');
    Route::get('/products/{product}/edit' , [ProductController::class,'edit'])->middleware('can:update,App\Models\Product');
    Route::put('/products/{product}' , [ProductController::class,'update'])->middleware('can:update,App\Models\Product');
    Route::delete('/products/{product}' , [ProductController::class,'destroy'])->middleware('can:delete,App\Models\Product');


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

Route::get('payment',[PayPalController::class,'payment']);
Route::get('cancel',[PayPalController::class,'cancel']);
Route::get('payment/success',[PayPalController::class,'success']);

Route::get('send-sms',[SmsController::class,'sms']);

Route::get('queued-jobs' , [QueuedJobsController::class,'index']);

Route::get('reduceStock/{id}' , [mainController::class,'reduceStock']);
