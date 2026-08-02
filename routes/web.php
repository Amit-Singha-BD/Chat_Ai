<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthenticationController::class, 'index'])->name('index');
Route::post('login', [AuthenticationController::class, 'login'])->name('login');
Route::get('register', [AuthenticationController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthenticationController::class, 'register'])->name('register.store');

Route::get('view', [ChatController::class, 'view'])->name('view');
Route::post('/chat/store', [ChatController::class, 'store'])->name('store');
