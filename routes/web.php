<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('users.login');
});

Route::resource('departments', DepartmentController::class);
Route::resource('employees', EmployeeController::class);
Route::resource('users', UserController::class);
Route::get('register', [UserController::class, 'registration'])->name('register');
Route::get('reports', [ReportsController::class, 'index'])->name('reports');