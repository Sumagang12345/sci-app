<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employee as Employee;

class PostDeductionController extends Controller
{
    public function store(Request $request)
    {
        if($request->amounts) {
            $data = array_filter($request->amounts);
            foreach($data as  $index => $amount) {
    
                Employee::updateOrCreate([
                    'FullName' => $request->fullnames[$index],
                ], [
                    'EmployeeID' => $request->ids[$index],
                    'FullName' => $request->fullnames[$index],
                    'Amount' => $amount,
                ]);
            }
        }
        return response()->json(['success' => true]);
    }
}
