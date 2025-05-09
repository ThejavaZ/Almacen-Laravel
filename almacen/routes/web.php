<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\UserController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::get('/password', [HomeController::class, 'password'])->name('password');

// Employees routes
Route::get('/employees', [EmployeesController::class, 'index'])->name('employees');
Route::get('/employees/create', [EmployeesController::class, 'create'])->name('employees.create');
Route::post('/employees/store', [EmployeesController::class, 'store'])->name('employees.store');
Route::get('/employees/report/pdf', [EmployeesController::class, 'pdf'])->name('employees.report.pdf');
Route::get('/employees/report/word', [EmployeesController::class, 'doc'])->name('employees.report.word');
Route::get('/employees/report/excel', [EmployeesController::class, 'xlsx'])->name('employees.report.excel');
Route::get('/employees/{id}', [EmployeesController::class, 'show'])->name('employees.show');
Route::get('/employees/{id}/edit', [EmployeesController::class, 'edit'])->name('employees.edit');
Route::post('/employees/{id}/update', [EmployeesController::class, 'update'])->name('employees.update');
Route::post('/employees/{id}/delete', [EmployeesController::class, 'destroy'])->name('employees.destroy');
Route::get('/employees/{id}/pdf', [EmployeesController::class, 'pdfID'])->name('employees.pdf');  
Route::get('/employees/{id}/card', [EmployeesController::class, 'card'])->name('employees.card');
Route::get('/employees/{id}/doc', [EmployeesController::class, 'docID'])->name('employees.doc');
Route::get('/employees/{id}/xlsx', [EmployeesController::class, 'xlsxID'])->name('employees.xlsx');

Route::get('/users',[UserController::class, 'index'])->name('users');
