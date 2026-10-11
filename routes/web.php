<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RiskAssessmentController;

Route::get('/', function () {
    return redirect()->route('assessments.create');
});

Route::get('/cek-risiko', [
    RiskAssessmentController::class,
    'create',
])->name('assessments.create');

Route::post('/assessments', [
    RiskAssessmentController::class,
    'store',
])->name('assessments.store');

// Authentication
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
