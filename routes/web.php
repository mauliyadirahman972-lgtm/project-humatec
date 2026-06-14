<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectManagementController;

Route::get('/', function () {
    return view('welcome');
});

// 1. Employees Routes
Route::prefix('employees')->group(function () {
    Route::get('/', [ProjectManagementController::class, 'getEmployees'])->name('employees.index');
    Route::get('/create', [ProjectManagementController::class, 'createEmployee'])->name('employees.create');
    Route::post('/', [ProjectManagementController::class, 'storeEmployee'])->name('employees.store');
    Route::get('/{employee}/edit', [ProjectManagementController::class, 'editEmployee'])->name('employees.edit');
    Route::put('/{employee}', [ProjectManagementController::class, 'updateEmployee'])->name('employees.update');
    Route::delete('/{employee}', [ProjectManagementController::class, 'deleteEmployee'])->name('employees.destroy');
});

// 2. Projects Routes
Route::prefix('projects')->group(function () {
    Route::get('/', [ProjectManagementController::class, 'getProjects'])->name('projects.index');
    Route::get('/create', [ProjectManagementController::class, 'createProject'])->name('projects.create');
    Route::post('/', [ProjectManagementController::class, 'storeProject'])->name('projects.store');
    Route::get('/{project}/edit', [ProjectManagementController::class, 'editProject'])->name('projects.edit');
    Route::put('/{project}', [ProjectManagementController::class, 'updateProject'])->name('projects.update');
    Route::delete('/{project}', [ProjectManagementController::class, 'deleteProject'])->name('projects.destroy');
});

// 3. Labels Routes
Route::prefix('labels')->group(function () {
    Route::get('/', [ProjectManagementController::class, 'getLabels'])->name('labels.index');
    Route::get('/create', [ProjectManagementController::class, 'createLabel'])->name('labels.create');
    Route::post('/', [ProjectManagementController::class, 'storeLabel'])->name('labels.store');
    Route::get('/{label}/edit', [ProjectManagementController::class, 'editLabel'])->name('labels.edit');
    Route::put('/{label}', [ProjectManagementController::class, 'updateLabel'])->name('labels.update');
    Route::delete('/{label}', [ProjectManagementController::class, 'deleteLabel'])->name('labels.destroy');
});

// 4. Tasks Routes
Route::prefix('tasks')->group(function () {
    Route::get('/', [ProjectManagementController::class, 'getTasks'])->name('tasks.index');
    Route::get('/create', [ProjectManagementController::class, 'createTask'])->name('tasks.create');
    Route::post('/', [ProjectManagementController::class, 'storeTask'])->name('tasks.store');
    Route::get('/{task}/edit', [ProjectManagementController::class, 'editTask'])->name('tasks.edit');
    Route::put('/{task}', [ProjectManagementController::class, 'updateTask'])->name('tasks.update');
    Route::delete('/{task}', [ProjectManagementController::class, 'deleteTask'])->name('tasks.destroy');
    
    // Task Assignments
    Route::post('/{task}/assign', [ProjectManagementController::class, 'assignEmployee'])->name('tasks.assign');
    Route::delete('/{task}/remove-assignments', [ProjectManagementController::class, 'removeAssignments'])->name('tasks.remove-assignments');
});

// 5. Task Assignments Routes
Route::prefix('task-assignments')->group(function () {
    Route::get('/', [ProjectManagementController::class, 'getTaskAssignments'])->name('task_assignments.index');
    Route::get('/create', [ProjectManagementController::class, 'createTaskAssignment'])->name('task_assignments.create');
    Route::post('/', [ProjectManagementController::class, 'storeTaskAssignment'])->name('task_assignments.store');
    Route::get('/{taskAssignment}/edit', [ProjectManagementController::class, 'editTaskAssignment'])->name('task_assignments.edit');
    Route::put('/{taskAssignment}', [ProjectManagementController::class, 'updateTaskAssignment'])->name('task_assignments.update');
    Route::delete('/{taskAssignment}', [ProjectManagementController::class, 'deleteTaskAssignment'])->name('task_assignments.destroy');
});
