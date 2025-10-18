<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    $projects = auth()->user()->projects()->with('tasks')->latest()->get();
    
    $stats = [
        'total_projects' => $projects->count(),
        'total_tasks' => $projects->sum(fn($p) => $p->tasks->count()),
        'completed_tasks' => $projects->sum(fn($p) => $p->tasks->where('is_completed', true)->count()),
    ];
    
    return Inertia::render('Dashboard', [
        'projects' => $projects->take(5), // Show only 5 recent projects
        'stats' => $stats
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Project routes
    Route::resource('projects', ProjectController::class);

    // Task routes (nested under projects for store, but shallow for update/delete)
    Route::post('projects/{project}/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::put('tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::patch('tasks/{task}/toggle', [TaskController::class, 'toggleComplete'])->name('tasks.toggle');
    Route::delete('tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
});

require __DIR__.'/auth.php';
