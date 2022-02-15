<?php

namespace App\Imports;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class ExcelImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if($row[0] == 'ID'){
        }else{
            if($row[2] == null){
                $amount = 0;
            }else{
                $amount = $row[2];
            }
            return new Employee([
                'EmployeeID'     => $row[0],
                'FullName'     => $row[1],
                'Amount'    => $amount,
            ]);
        }
    }
}
