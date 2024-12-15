<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\QuizController;

use App\Http\Controllers\CategoryController;
// Quiz Routes
Route::get('/', [QuizController::class, 'index'])->name('quiz.index');
Route::get('/quiz/{id}', [QuizController::class, 'show'])->name('quiz.show');
Route::post('/quiz/{id}/submit', [QuizController::class, 'submit'])->name('quiz.submit');
Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');

Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::get('/', [QuizController::class, 'index'])->name('quiz.index');
Route::post('/quiz/{id}/submit', [QuizController::class, 'submit'])->name('quiz.submit');
Route::post('/quiz/{id}/submit', [QuizController::class, 'submit'])->name('quiz.submit');


Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

// Add Category
Route::get('/categories/add', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');

// Edit Category
Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::post('/categories/{id}/update', [CategoryController::class, 'update'])->name('categories.update');

// Delete Category
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
