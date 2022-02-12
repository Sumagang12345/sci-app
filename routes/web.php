<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\PostController;

Auth::routes(['register' => false, 'verify' => false]);
Route::redirect('/', 'login');
Route::get('/home', [HomeController::class, 'index'])->name('home');



Route::get('/import', [ImportController::class, 'index'])->name('import');
Route::post('create', [ImportController::class, 'store'])->name('import.add');



Route::get('/post', [PostController::class, 'index'])->name('post');


