<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\FormulasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManagementUnitController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TargetController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('login', [LoginController::class, 'view']);
Route::post('login', [LoginController::class, 'authenticate']);

Route::get('/target', [TargetController::class, 'index'])->name('target.index');
Route::post('/target', [TargetController::class, 'save'])->name('target.save');

Route::get('/capaian', [AchievementController::class, 'index'])->name('achievement.index');
Route::post('/capaian', [AchievementController::class, 'save'])->name('achievement.save');

Route::get('/skor', [FormulasController::class, 'index']);
Route::get('/generate', [FormulasController::class, 'generate'])->name('formula.generate');

// Management Unit
Route::get('/management-unit/{id?}', [ManagementUnitController::class, 'view']);
Route::post('/management-unit', [ManagementUnitController::class, 'create']);
Route::put('/management-unit/{id}', [ManagementUnitController::class, 'update']);
Route::delete('/management-unit/{id}', [ManagementUnitController::class, 'remove']);
