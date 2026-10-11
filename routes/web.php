<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RiskAssessmentController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/assessments', [
    RiskAssessmentController::class,
    'store',
])->name('assessments.store');