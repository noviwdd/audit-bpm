<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\FormulasController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TargetController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/target', [TargetController::class, 'index'])->name('target.index');
Route::post('/target', [TargetController::class, 'save'])->name('target.save');

Route::get('/capaian', [AchievementController::class, 'index'])->name('achievement.index');
Route::post('/capaian', [AchievementController::class, 'save'])->name('achievement.save');

Route::get('/skor', [FormulasController::class, 'index']);
Route::get('/generate', [FormulasController::class, 'generate'])->name('formula.generate');
