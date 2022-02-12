<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\PostController;

Auth::routes(['register' => false, 'verify' => false]);
Route::redirect('/', 'login');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/logout', [HomeController::class, 'logout']);


Route::get('/import_export', [ImportController::class, 'index'])->name('import_export');
Route::post('import', [ImportController::class, 'store'])->name('import');

Route::get('export', [ImportController::class, 'create'])->name('export');



Route::get('/post', [PostController::class, 'index'])->name('post');
Route::get('/listOfEmployee', [PostController::class, 'listOfEmployee']);




