<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CategoryController;

Route::redirect('/', '/login');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/user/dashboard', function () {
        $books = \App\Models\Book::with(['category', 'user'])->latest()->take(8)->get();
        $categories = \App\Models\Category::withCount('books')->orderByDesc('books_count')->take(5)->get();

        return view('user.dashboard', compact('books', 'categories'));
    })->name('user.dashboard');

    Route::get('/koleksi-buku', [BookController::class, 'catalog'])->name('user.books');

    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::resource('books', BookController::class);
        Route::resource('users', UserController::class);
        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    });
});
