<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\employee as Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImportController;

Auth::routes(['register' => false, 'verify' => false]);
Route::redirect('/', 'login');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('print-employees', function () {
    $employees = Employee::get();
    $pdf = App::make('snappy.pdf.wrapper');

    $pdf->loadView('reports.employees-print',
        compact('employees'))
        ->setPaper('a4')
        ->setOption('margin-bottom', 0)
        ->setOrientation('portrait');
        return $pdf->inline();
})->name('print-employees');

Route::post('send-data', function (Request $request) {
    // ABARICO, BERNIE CALUDRE
    $data = array_filter($request->amounts);
    foreach($data as  $index => $amount) {
        Employee::updateOrCreate([
            'EmployeeID' => $request->ids[$index],
            'FullName' => $request->fullnames[$index],
        ], [
            'EmployeeID' => $request->ids[$index],
            'FullName' => $request->fullnames[$index],
            'Amount' => $amount
        ]);
    }

    return response()->json(['success' => true]);
});

Route::get('/logout', [HomeController::class, 'logout']);


Route::get('/import_export', [ImportController::class, 'index'])->name('import_export');
Route::post('import', [ImportController::class, 'store'])->name('import');

Route::get('export', [ImportController::class, 'create'])->name('export');



Route::get('/post', [PostController::class, 'index'])->name('post');
Route::get('/listOfEmployee', [PostController::class, 'listOfEmployee']);
Route::post('/update/{employeeID}', [PostController::class, 'update']);
Route::post('/create', [PostController::class, 'store']);
Route::post('/delete/{employeeID}', [PostController::class, 'destroy']);





