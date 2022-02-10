<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Auth::routes(['register' => false, 'verify' => false]);
Route::redirect('/', 'login');
Route::get('/home', [HomeController::class, 'index'])->name('home');

