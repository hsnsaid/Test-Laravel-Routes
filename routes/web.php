<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\StatsController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

// Task 1: point the main "/" URL to the HomeController method "index"
Route::get("/", [HomeController::class, 'index']);

// Task 2: point the GET URL "/user/[name]" to the UserController method "show"
Route::get("/user/{name}", [UserController::class, 'show']);

// Task 3: point the GET URL "/about" to the view
Route::view('/about', 'pages.about')->name('about');

// Task 4: redirect the GET URL "log-in" to a URL "login"
Route::redirect("/log-in", "/login");

// Task 5: group the following route sentences below in Route::group()
// Assign middleware "auth"
Route::middleware(['auth'])->group(function() {
    // Task 6: /app group within a group
    // Add another group for routes with prefix "app"
    Route::prefix('app')->group(function() {
        // Task 7: point URL /app/dashboard to a "Single Action" DashboardController
        // Assign the route name "dashboard"
        Route::get('dashboard', DashboardController::class)->name('dashboard');
        // Task 8: Manage tasks with URL /app/tasks/***.
        // Add ONE line to assign 7 resource routes to TaskController
        Route::resource('tasks', TaskController::class);
    });
    // Task 9: /admin group within a group
    // Add a group for routes with URL prefix "admin"
    // Assign middleware called "is_admin" to them
    Route::group(['prefix' => 'admin', 'middleware' => 'is_admin'], function() {
        // Task 10: point URL /admin/dashboard to a "Single Action" Admin/DashboardController
        // Put one code line here below
        Route::get('dashboard', AdminDashboardController::class);
        // Task 11: point URL /admin/stats to a "Single Action" Admin/StatsController
        // Put one code line here below
        Route::get('stats', StatsController::class);
    });
});

// One more task is in routes/api.php

require __DIR__.'/auth.php';
