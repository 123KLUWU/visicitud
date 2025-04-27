<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\AuthController; 


//las rutas que no estan agrupadas estan disponibles para todos los usuarios
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'index'])->name('login.view');
Route::post('/login', [AuthController::class, 'login'])->name('login');

//ruta para cerrar sesion
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//rutas para el registro de usuarios
Route::get('/register', [AuthController::class, 'registro'])->name('register.view');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::middleware('auth')->group(function () {
    Route::get('/fgeggdfdg', [LayoutController::class, 'index'])->name('inicio');

    Route::get('/tasks', [TasksController::class, 'index'])->name('tasks.index');

    Route::get('/tasks/create', [TasksController::class, 'create'])->name('tasks.create');
    Route::post('/tasks/create', [TasksController::class, 'store'])->name('tasks.store');

    Route::get('/tasks/{id}', [TasksController::class, 'show'])->name('tasks.show');

    Route::get('/tasks/{id}/edit', [TasksController::class, 'edit'])->name('tasks.edit');

    Route::post('/tasks/{id}/edit', [TasksController::class, 'update'])->name('tasks.update');
    
    Route::delete('/tasks/{id}/destroy', [TasksController::class, 'destroy'])->name('tasks.destroy');

    Route::post('/tasks/complete', [TasksController::class, 'complete'])->name('tasks.complete');
});