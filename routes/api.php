<?php

use App\Http\Controllers\TranslationController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/translations', [TranslationController::class, 'index']);
    Route::post('/store/translations', [TranslationController::class, 'store']);
    Route::post('/translations/{translation}', [TranslationController::class, 'update']);
    Route::get('/translations/{translation}', [TranslationController::class, 'show']);
    Route::get('/translations/export/{locale}', [TranslationController::class, 'export']);
});
