<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormulasController;
use App\Http\Controllers\GraphController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManagementUnitController;
use App\Http\Controllers\ManagementUserController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UnitDetailController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth
Route::get('/login', [AuthController::class, 'index']);

Route::get('login', [LoginController::class, 'view']);
Route::post('login', [LoginController::class, 'authenticate']);

// Achievement
Route::get('/capaian', [AchievementController::class, 'index'])->name('achievement.index');
Route::post('/capaian', [AchievementController::class, 'save'])->name('achievement.save');

// Target
Route::get('/target', [TargetController::class, 'index'])->name('target.index');
Route::post('/target', [TargetController::class, 'save'])->name('target.save');

// Score
Route::get('/skor', [FormulasController::class, 'index']);
Route::get('/generate', [FormulasController::class, 'generate'])->name('formula.generate');

// Graph
Route::get('/grafik', [GraphController::class, 'index']);
Route::get('/get-grafik-data', [GraphController::class, 'getChartData']);

// Management Unit
Route::get('/manajemen-unit', [ManagementUnitController::class, 'index'])->name('management-unit.index');
Route::post('/manajemen-unit/{id?}', [ManagementUnitController::class, 'store'])->name('management-unit.store');
Route::delete('/manajemen-unit/{id}', [ManagementUnitController::class, 'destroy'])->name('management-unit.destroy');

// Management User
Route::get('/manajemen-pengguna', [ManagementUserController::class, 'index']);
Route::get('/manajemen-pengguna/form', [ManagementUserController::class, 'create']);


// Unit
Route::get('/units/{id?}', [UnitController::class, 'view']);
Route::post('/units', [UnitController::class, 'create']);
Route::put('/units/{id}', [UnitController::class, 'update']);
Route::delete('/units/{id}', [UnitController::class, 'remove']);

// Unit Detail
Route::get('/unit/{unit_id}/details/{id?}', [UnitDetailController::class, 'view'])->name('unit-detail.view');
Route::post('/unit/{unit_id}/details', [UnitDetailController::class, 'create']);
Route::put('/unit/{unit_id}/details/{id}', [UnitDetailController::class, 'update']);
Route::delete('/unit/{unit_id}/details/{id}', [UnitDetailController::class, 'remove']);
