<?php

use Illuminate\Support\Facades\Route;
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