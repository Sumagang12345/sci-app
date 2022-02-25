<?php

use App\Http\Controllers\AccountSettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\employee as Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\PostDeductionController;
use App\Http\Controllers\PrintEmployeesController;

Auth::routes(['register' => false, 'verify' => false]);
Route::redirect('/', 'login');




Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/import_export', [ImportController::class, 'index'])->name('import_export');
    Route::post('import', [ImportController::class, 'store'])->name('import');

    Route::get('export', [ImportController::class, 'create'])->name('export');

    Route::get('/post', [PostController::class, 'index'])->name('post');
    Route::get('/listOfEmployee', [PostController::class, 'listOfEmployee']);
    Route::post('/update/{employeeID}', [PostController::class, 'update']);
    Route::post('/create', [PostController::class, 'store']);
    Route::post('/delete/{employeeID}', [PostController::class, 'destroy']);
    Route::get('print-employees', [PrintEmployeesController::class, 'print'])->name('print-employees');
    Route::post('send-data', [PostDeductionController::class, 'store']);

    Route::get('account/setting', [AccountSettingController::class, 'edit'])->name('account.setting');
    Route::put('account/setting', [AccountSettingController::class, 'update'])->name('account.setting.update');
});




