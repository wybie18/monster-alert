<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MonsterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\User\MapController;
use App\Http\Controllers\User\ReportController;
use App\Http\Controllers\User\UserDashboardController;
use App\Models\MonsterSightings;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified', 'role:admin'])->group(function() {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/admin/monsters', MonsterController::class);
    Route::get('/admin/submissions', [SubmissionController::class, 'index'])->name('submissions.index');
    Route::put('/admin/submissions/{id}', [SubmissionController::class, 'approve'])->name('submissions.approve');
    Route::delete('/admin/submissions/{id}', [SubmissionController::class, 'destroy'])->name('submissions.destroy');

    Route::get('/admin/profile', [ProfileController::class, 'admin'])->name('profile.edit');
});

Route::middleware(['auth', 'verified', 'role:user'])->group(function() {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/report', [ReportController::class, 'index'])->name('user.report');
    Route::post('/report', [ReportController::class, 'store'])->name('user.report.store');
    Route::get('/map', [MapController::class, 'index'])->name('user.map');

    Route::get('/profile', [ProfileController::class, 'user'])->name('user.profile.edit');
});

Route::middleware('auth')->group(function () {
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
