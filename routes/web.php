<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;

Route::get('/', function () { return view('welcome'); });

// Admin login custom page
Route::get('/panel/control-login', function () {
    if (auth()->check() && auth()->user()->role === 'admin') {
        return redirect()->route('dashboard');
    }
    return view('auth.admin-login');
})->name('admin.secret.login');

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/chatbot/message', [ChatbotController::class, 'handleMessage'])->name('chatbot.message');

    // 🔄 STATUS UPDATE ROUTE (Resource se pehle)
    Route::patch('/tasks/{task}/update-status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');

    // Task Routes
    Route::get('/tasks/filter', [TaskController::class, 'filter'])->name('tasks.filter');
    Route::resource('tasks', TaskController::class);
    Route::post('/tasks/{task}/upload', [TaskController::class, 'uploadFile'])->name('tasks.upload');
    Route::delete('/tasks/{task}/file/{attachment}', [TaskController::class, 'deleteFile'])->name('tasks.file.delete');

    // Admin ke liye user registration ka custom route
    Route::middleware(['auth'])->group(function () {
        Route::get('/admin/register-member', [App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])
            ->name('admin.register.member');
    });

    // Profile Routes
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
    Route::delete('/tasks/{task}/attachments/{attachment}', [TaskController::class, 'deleteFile'])->name('attachments.destroy');

    // Admin Only Routes (Role Middleware)
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('teams', TeamController::class);
        Route::post('/teams/{team}/members', [TeamController::class, 'addMember'])->name('teams.addMember');
        Route::delete('/teams/{team}/members/{user}', [TeamController::class, 'removeMember'])->name('teams.removeMember');
    });
    
});

require __DIR__.'/auth.php';