<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\employee as Employee;

class PrintEmployeesController extends Controller
{
    public function print()
    {
        $employees = Employee::get();
        $totalAmount = number_format(Employee::sum('amount'), 2, '.', ',');
        $pdf = App::make('snappy.pdf.wrapper');
    
        $pdf->loadView('reports.employees-print', compact(['employees','totalAmount']))
                        ->setPaper('a4')
                        ->setOption('margin-bottom', 0)
                        ->setOrientation('portrait');
                        
            return $pdf->inline();
    }
}
