<?php

use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------|
| Web Routes                                                               |
|--------------------------------------------------------------------------|
| Here is where you can register web routes for your application. These    |
| routes are loaded by the RouteServiceProvider and all of them will       |
| be assigned to the "web" middleware group. Make something great!         |
|--------------------------------------------------------------------------|
*/

Route::view('/', 'welcome');
Route::post('submission', [ProjectController::class, 'sendSubmission'])->name('submission');

Route::view('dashboard', 'dashboard', ['pageTitle' => 'Dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function() {
    // Route for Admin
    Route::view('admin-dashboard', 'admin-dashboard', ['pageTitle' => 'Dashboard'])->name('admin-dashboard');
    Route::view('admin-projects', 'admin-projects', ['pageTitle' => 'Projects'])->name('admin-projects');

    // Route for displaying Todo list
    Route::get('admin-todo', [TodoListController::class, 'todo'])->name('admin-todo');

    // Route for displaying create Todo form
    Route::post('admin-todocreate', [TodoListController::class, 'store'])->name('admin-todocreate');
    Route::delete('admin-tododestroy/{id}', [TodoListController::class, 'destroy'])->name('admin-tododestroy');

});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
