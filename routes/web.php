
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
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\DiscussionModerationController;

use App\Http\Controllers\Moderator\DashboardController as ModeratorDashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Moderator\DiscussionReportController as ModeratorDiscussionReportController;
use App\Http\Controllers\Admin\DiscussionReportController as AdminDiscussionReportController;

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
            AdminDashboardController::class,
            'index',
        ])->name('dashboard');

        // Manajemen pengguna
        Route::get('/users', [
            UserManagementController::class,
            'index',
        ])->name('users.index');

        Route::get('/users/{user}', [
            UserManagementController::class,
            'show',
        ])->name('users.show');

        Route::patch('/users/{user}/role', [
            UserManagementController::class,
            'updateRole',
        ])->name('users.role.update');

        // Laporan khusus Admin
        Route::get('/reports', [
            AdminDiscussionReportController::class,
            'index',
        ])->name('reports.index');

        Route::get('/reports/{id}', [
            AdminDiscussionReportController::class,
            'show',
        ])->whereNumber('id')->name('reports.show');

        Route::patch('/reports/{id}/status', [
            AdminDiscussionReportController::class,
            'update',
        ])->whereNumber('id')->name('reports.update');

        Route::get('/discussions', [
            DiscussionModerationController::class,
            'index',
        ])->name('discussions.index');

        Route::get('/discussions/{id}', [
            DiscussionModerationController::class,
            'show',
        ])->whereNumber('id')->name('discussions.show');

        Route::patch('/discussions/{id}/approve', [
            DiscussionModerationController::class,
            'approve',
        ])->whereNumber('id')->name('discussions.approve');

        Route::patch('/discussions/{id}/reject', [
            DiscussionModerationController::class,
            'reject',
        ])->whereNumber('id')->name('discussions.reject');
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


/*
|--------------------------------------------------------------------------
| Dashboard Moderator
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:moderator'])
    ->prefix('moderator')
    ->name('moderator.')
    ->group(function () {
        Route::get('/', [
            ModeratorDashboardController::class,
            'index',
        ])->name('dashboard');

        Route::get('/reports', [
            ModeratorDiscussionReportController::class,
            'index',
        ])->name('reports.index');

        Route::get('/reports/{id}', [
            ModeratorDiscussionReportController::class,
            'show',
        ])->whereNumber('id')->name('reports.show');

        Route::patch('/reports/{id}/status', [
            ModeratorDiscussionReportController::class,
            'update',
        ])->whereNumber('id')->name('reports.update');
    });
