<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    
    // Task Management Routes
    Route::resource('tasks', App\Http\Controllers\TaskController::class);
    
    // Content Ideas Routes
    Route::resource('content-ideas', App\Http\Controllers\ContentIdeaController::class);
    
    // Journal Routes
    Route::resource('journal', App\Http\Controllers\JournalEntryController::class);
    
    // Content Log Routes
    Route::resource('content-logs', App\Http\Controllers\ContentLogController::class);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
