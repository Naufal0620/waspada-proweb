
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
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
| Halaman Utama & Cek Risiko
|--------------------------------------------------------------------------
*/

Route::get('/', [
    HomeController::class,
    'index',
])->name('home');

Route::get('/cek-risiko', [
    RiskAssessmentController::class,
    'create',
])->name('assessments.create');

Route::post('/assessments', [
    RiskAssessmentController::class,
    'store',
])->name('assessments.store');

Route::get('/assessments/{assessment}', [
    RiskAssessmentController::class,
    'show',
])->name('assessments.show');

/*
|--------------------------------------------------------------------------
| Autentikasi & Reset Password
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

    // Forgot Password
    Route::get('/forgot-password', [
        ForgotPasswordController::class,
        'showLinkRequestForm',
    ])->name('password.request');

    Route::post('/forgot-password', [
        ForgotPasswordController::class,
        'sendResetLinkEmail',
    ])->name('password.email');

    // Reset Password
    Route::get('/reset-password/{token}', [
        ResetPasswordController::class,
        'showResetForm',
    ])->name('password.reset');

    Route::post('/reset-password', [
        ResetPasswordController::class,
        'reset',
    ])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [
        AuthController::class,
        'logout',
    ])->name('logout');

    // Email Verification Notice & Handlers
    Route::get('/email/verify', [
        VerificationController::class,
        'notice',
    ])->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [
        VerificationController::class,
        'verify',
    ])->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', [
        VerificationController::class,
        'resend',
    ])->middleware('throttle:6,1')->name('verification.send');

    // User Dashboard
    Route::get('/dashboard', [
        UserDashboardController::class,
        'index',
    ])->name('dashboard');
});

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

        // Monitoring Asesmen Pengguna
        Route::get('/assessments', [
            \App\Http\Controllers\Admin\AssessmentManagementController::class,
            'index',
        ])->name('assessments.index');

        Route::get('/assessments/{assessment}', [
            \App\Http\Controllers\Admin\AssessmentManagementController::class,
            'show',
        ])->name('assessments.show');
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

        // Owner Controls untuk Diskusi
        Route::get('/{discussion:slug}/edit', [
            DiscussionController::class,
            'edit',
        ])->name('edit');

        Route::put('/{discussion:slug}', [
            DiscussionController::class,
            'update',
        ])->name('update');

        Route::delete('/{discussion:slug}', [
            DiscussionController::class,
            'destroy',
        ])->name('destroy');

        // Komentar
        Route::post('/{slug}/komentar', [
            DiscussionCommentController::class,
            'store',
        ])->name('comments.store');

        Route::put('/{slug}/komentar/{comment}', [
            DiscussionCommentController::class,
            'update',
        ])->name('comments.update');

        Route::delete('/{slug}/komentar/{comment}', [
            DiscussionCommentController::class,
            'destroy',
        ])->name('comments.destroy');

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
