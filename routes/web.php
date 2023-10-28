<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [TaskController::class, 'index'])->name('indeks');

Route::post('/associated-tasks', [ProjectController::class, 'associatedTasks'])->name('associated-tasks');

Route::post('/reorder', [TaskController::class, 'reorder'])->name('reorder');
Route::resource('tasks', TaskController::class);
