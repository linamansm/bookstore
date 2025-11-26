<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;


Route::get('/', function () {
    return view('welcome');
  });//->middleware(['auth', 'verified'])->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/products', function () {
    return view('products');
})->middleware(['auth', 'verified'])->name('products');


Route::get('/about', function () {
    return view('about');
})->middleware(middleware: ['auth', 'verified'])->name('about');

Route::get('/add', function () {
    return view('add');
})->middleware(middleware: ['auth', 'verified', 'admin'])->name('add');

Route::get('/cart', function () {
    return view('cart');
})->middleware(middleware: ['auth', 'verified'])->name('cart');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Edit / Update
Route::get('/book/{book}/edit', [BookController::class, 'edit'])->name('book.edit');
Route::put('/book/{book}', [BookController::class, 'update'])->name('book.update');

// Delete
Route::delete('/book/{book}', [BookController::class, 'destroy'])->name('book.destroy');






// Show the form
Route::get('/book/create', [BookController::class, 'create'])->name('book.create');

// Save the form
Route::post('/book', [BookController::class, 'store'])->name('book.store');

// Display all books
Route::get('/book', [BookController::class, 'index'])->name('book.index');
// web.php
Route::get('/book/{book}', [BookController::class, 'show'])->name('book.show');

Route::post('/book/{book}/favorite', [BookController::class, 'favorite'])->name('book.favorite');
Route::get('cart', action: [BookController::class, 'favorites'])->name('cart');


use App\Http\Controllers\StatisticsController;

Route::get('/dashboard', [StatisticsController::class, 'dashboard'])->name('dashboard');



require __DIR__.'/auth.php';
