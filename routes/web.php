<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\FormulasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManagementUnitController;
use App\Http\Controllers\ManagementUserController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\UnitController;
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
Route::get('/management-units/{id?}', [ManagementUnitController::class, 'view']);
Route::post('/management-units', [ManagementUnitController::class, 'create']);
Route::put('/management-units/{id}', [ManagementUnitController::class, 'update']);
Route::delete('/management-units/{id}', [ManagementUnitController::class, 'remove']);

// Management User
Route::get('/management-users/{id?}', [ManagementUserController::class, 'view']);
Route::post('/management-users', [ManagementUserController::class, 'create']);
Route::put('/management-users/{id}', [ManagementUserController::class, 'update']);
Route::delete('/management-users/{id}', [ManagementUserController::class, 'remove']);

// Unit
Route::get('/units/{id?}', [UnitController::class, 'view']);
Route::post('/units', [UnitController::class, 'create']);
Route::put('/units/{id}', [UnitController::class, 'update']);
Route::delete('/units/{id}', [UnitController::class, 'remove']);
