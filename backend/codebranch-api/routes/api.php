<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::group(['middleware' => ['web']], function () {
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/login', [AuthController::class, 'login']);