<?php

use Illuminate\Support\Facades\Route;
use wdd\slug\Http\Controllers\SlugController;

Route::get('slug-generate' ,[SlugController::class,'index']);
