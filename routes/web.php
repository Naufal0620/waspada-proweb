
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RiskAssessmentController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\DiscussionCreateController;
use App\Http\Controllers\DiscussionCommentController;
use App\Http\Controllers\DiscussionVoteController;
use App\Http\Controllers\DiscussionReportController;

use App\Http\Controllers\Moderator\DashboardController as ModeratorDashboardController;
use App\Http\Controllers\Moderator\DiscussionReportController as ModeratorDiscussionReportController;

/*
|--------------------------------------------------------------------------
| Halaman Utama dan Cek Risiko
|--------------------------------------------------------------------------
*/

Route::redirect('/', '/cek-risiko');

Route::get('/cek-risiko', [
    RiskAssessmentController::class,
    'create',
])->name('assessments.create');

Route::post('/assessments', [
    RiskAssessmentController::class,
    'store',
])->name('assessments.store');

/*
|--------------------------------------------------------------------------
| Autentikasi
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [
        AuthController::class,
        'showLogin',
    ])->name('login');

    Route::post('/login', [
        AuthController::class,
        'login',
    ])->name('login.store');

    Route::get('/register', [
        AuthController::class,
        'showRegister',
    ])->name('register');

    Route::post('/register', [
        AuthController::class,
        'register',
    ])->name('register.store');
});

Route::post('/logout', [
    AuthController::class,
    'logout',
])->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| Dashboard Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [
            DashboardController::class,
            'admin',
        ])->name('dashboard');
    });

/*
|--------------------------------------------------------------------------
| Forum Diskusi
|--------------------------------------------------------------------------
*/

Route::prefix('forum')->name('forum.')->group(function () {

    // Halaman publik
    Route::get('/', [
        DiscussionController::class,
        'index',
    ])->name('index');

    Route::get('/{slug}', [
        DiscussionController::class,
        'show',
    ])->name('show');

    // Fitur yang membutuhkan login
    Route::middleware('auth')->group(function () {
        Route::get('/buat', [
            DiscussionCreateController::class,
            'create',
        ])->name('create');

        Route::post('/', [
            DiscussionCreateController::class,
            'store',
        ])->name('store');

        Route::post('/{slug}/komentar', [
            DiscussionCommentController::class,
            'store',
        ])->name('comments.store');

        Route::post('/{slug}/vote', [
            DiscussionVoteController::class,
            'toggle',
        ])->name('votes.toggle');

        Route::post('/{slug}/laporkan', [
            DiscussionReportController::class,
            'store',
        ])->name('reports.store');
    });
});

/*
|--------------------------------------------------------------------------
| Dashboard Moderator
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin,moderator'])
    ->prefix('moderator')
    ->name('moderator.')
    ->group(function () {

        Route::get('/', [
            ModeratorDashboardController::class,
            'index',
        ])->name('dashboard');

        // Daftar laporan
        Route::get('/reports', [
            ModeratorDiscussionReportController::class,
            'index',
        ])->name('reports.index');

        // Detail laporan
        Route::get('/reports/{id}', [
            ModeratorDiscussionReportController::class,
            'show',
        ])->whereNumber('id')->name('reports.show');

        // Memproses status laporan
        Route::patch('/reports/{id}/status', [
            ModeratorDiscussionReportController::class,
            'update',
        ])->whereNumber('id')->name('reports.update');
    });
