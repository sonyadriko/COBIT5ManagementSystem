<?php

use App\Http\Controllers\AuditProcessController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/audit-process', [AuditProcessController::class, 'index'])->name('audit-process.index');
    Route::get('/audit-process/create', [AuditProcessController::class, 'create'])->name('audit-process.create');
    Route::post('/audit-process/create', [AuditProcessController::class, 'store'])->name('audit-process.store');
    Route::get('/audit-process/edit/{id}', [AuditProcessController::class, 'edit'])->name('audit-process.edit');
    Route::put('/audit-process/edit/{id}', [AuditProcessController::class, 'update'])->name('audit-process.update');

    Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');
    Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create');
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
    Route::get('/questions/edit/{id}', [QuestionController::class, 'edit'])->name('questions.edit');
    Route::put('/questions/edit/{id}', [QuestionController::class, 'update'])->name('questions.update');
    Route::delete('/questions/delete/{id}', [QuestionController::class, 'destroy'])->name('questions.destroy');

    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects/create', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/edit/{id}', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/edit/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/delete/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::get('/projects/report/{id}', [ProjectController::class, 'showReport'])->name('projects.report');

    Route::get('/projects/{id}', [ProjectController::class, 'audit'])->name('projects.audit');
    Route::get('/projects/{id}/add', [ProjectController::class, 'createAudit'])->name('projects.audit.create');
    Route::post('/projects/{id}/store', [ProjectController::class, 'storeAudit'])->name('projects.audit.store');
    Route::delete('/projects/{id_project}/delete/{id}', [ProjectController::class, 'deleteAudit'])->name('projects.audit.delete');

    Route::get('/projects/{id_project}/audit/{id}', [ProjectController::class, 'auditProject'])->name('projects.audit.detail');
    Route::post('/projects/{id_project}/audit/store/{id}', [ProjectController::class, 'storeAuditDetail'])->name('projects.audit.detail.store');




    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/create', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/edit/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});



require __DIR__.'/auth.php';
