<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// routes/api.php
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user(); // Returns the authenticated user
    });

    Route::get('/codeblocks', [\App\Http\Controllers\BranchController::class, 'index']);
    Route::get('/codeblocks/{id}', [\App\Http\Controllers\BranchController::class, 'show']);
    Route::post('codeblock/add', [\App\Http\Controllers\BranchController::class, 'add']);
    
    // Add other protected routes here
});

Route::group(['middleware' => ['web']], function () {
    Route::post('/login', [AuthController::class, 'login']);
});