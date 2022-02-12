<?php

namespace App\Imports;
use App\Models\employee;
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
            return new employee([
                'EmployeeID'     => $row[0],
                'FullName'     => $row[1],
                'Amount'    => $row[2],
            ]);
        }
    }
}
