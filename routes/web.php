<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Task\TaskController;
use App\Http\Controllers\Task\TaskStatusController;
use App\Http\Controllers\LabelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('tasks', TaskController::class);
Route::resource('task_statuses', TaskStatusController::class);
Route::resource('labels', LabelController::class);

require __DIR__ . '/auth.php';
