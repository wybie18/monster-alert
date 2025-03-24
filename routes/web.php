<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MonsterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubmissionController;
use App\Models\MonsterSightings;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
    Route::resource('/admin/monsters', MonsterController::class);
    Route::get('/admin/submissions', [SubmissionController::class, 'index'])->name('submissions.index');
    Route::put('/admin/submissions/{id}', [SubmissionController::class, 'approve'])->name('submissions.approve');
    Route::delete('/admin/submissions/{id}', [SubmissionController::class, 'destroy'])->name('submissions.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
