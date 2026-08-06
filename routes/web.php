<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::get('/login', [AuthenticationController::class, 'loginView'])->name('login.view');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthenticationController::class, 'registerView'])->name('register.view');
Route::post('/register', [AuthenticationController::class, 'register'])->name('register.store');

// Chat Routes
Route::get('/', [ChatController::class, 'index'])->name('chat.index');
Route::post('/chat', [ChatController::class, 'store'])->name('chat.store');
Route::get('/chat/{conversation}', [ChatController::class, 'show'])->name('chat.show');
