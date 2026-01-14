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
    Route::post('codeblock/{id}/revision/add', [\App\Http\Controllers\BranchController::class, 'revisionAdd']);
    Route::get('/codeblocks/revision/{id}', [\App\Http\Controllers\BranchController::class, 'getRevision']);
    
    // Add other protected routes here
    Route::post('/logout', [function (Request $request) {
        // 1. If it is a real API token, delete it from the database
    if (method_exists($request->user()->currentAccessToken(), 'delete')) {
        $request->user()->currentAccessToken()->delete();
    }

        // 2. Always logout of the web/session guard
        auth()->guard('web')->logout();

        // 3. Clear the session if using SPA authentication
        if ($request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return response()->json(['message' => 'Logged out successfully']);
        }]);
});

Route::group(['middleware' => ['web']], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});