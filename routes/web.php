<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MyShelfController;
use App\Http\Controllers\QuizController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/explore', [ProdukController::class, 'explore'])->name('produk.explore');
Route::get('/explore/{book}', [ProdukController::class, 'show'])->name('produk.show');
Route::get('/read/{book}', [ProdukController::class, 'read'])->name('produk.read')->middleware('auth');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/my-shelf', [MyShelfController::class, 'index'])->name('myshelf');
Route::get('/book-club', [App\Http\Controllers\BookClubController::class, 'index'])->name('bookclub');

Route::middleware('auth')->group(function () {
    Route::get('/quiz/step1', [QuizController::class, 'step1'])->name('quiz.step1');
    Route::post('/quiz/step1', [QuizController::class, 'processStep1']);
    Route::get('/quiz/step2', [QuizController::class, 'step2'])->name('quiz.step2');
    Route::post('/quiz/step2', [QuizController::class, 'processStep2']);
    Route::get('/quiz/step3', [QuizController::class, 'step3'])->name('quiz.step3');
    Route::post('/quiz/step3', [QuizController::class, 'processStep3']);
    
    Route::post('/book/{book}/favorite', [App\Http\Controllers\UserInteractionController::class, 'toggleFavorite'])->name('book.favorite');
    Route::post('/book/{book}/progress', [App\Http\Controllers\UserInteractionController::class, 'saveProgress'])->name('book.progress');
    
    Route::post('/book-club/post', [App\Http\Controllers\BookClubController::class, 'store'])->name('bookclub.store');
    Route::post('/book-club/post/{post}/like', [App\Http\Controllers\BookClubController::class, 'toggleLike'])->name('bookclub.like');
    Route::post('/book-club/post/{post}/comment', [App\Http\Controllers\BookClubController::class, 'storeComment'])->name('bookclub.comment');
    
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
