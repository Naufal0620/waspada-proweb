<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RiskAssessmentController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\DiscussionCreateController;
use App\Http\Controllers\DiscussionCommentController;
use App\Http\Controllers\DiscussionVoteController;

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

Route::middleware(['auth', 'role:admin'])
    ->get('/admin', [DashboardController::class, 'admin'])
    ->name('admin.dashboard');

Route::middleware(['auth', 'role:admin,moderator'])
    ->get('/moderator', [DashboardController::class, 'moderator'])
    ->name('moderator.dashboard');

Route::prefix('forum')->name('forum.')->group(function () {
    Route::get('/', [DiscussionController::class, 'index'])
        ->name('index');

    Route::middleware('auth')->group(function () {
        Route::get('/buat', [DiscussionCreateController::class, 'create'])
            ->name('create');

        Route::post('/', [DiscussionCreateController::class, 'store'])
            ->name('store');
        Route::post(
            '/{slug}/komentar',
            [DiscussionCommentController::class, 'store']
        )->name('comments.store');
        Route::post('/{slug}/vote', [DiscussionVoteController::class, 'toggle'])
            ->name('votes.toggle');
    });

    Route::get('/{slug}', [DiscussionController::class, 'show'])
        ->name('show');
});