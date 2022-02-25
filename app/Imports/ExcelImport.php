<?php

namespace App\Imports;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
class ExcelImport implements ToCollection
{
    private $postDate;
    
    public function __construct($postDate)
    {
        $this->postDate = $postDate;
    }
    public function collection(Collection $rows)
    {
        $index = 0;
        $rows->each(function ($row) use(&$index) {
            if($index != 0) {
                Employee::updateOrCreate([
                    'FullName' => $row[1],
                ], [
                    'EmployeeID' => strlen($row[0]) != 4 ? str_pad($row[0], 4, "0", STR_PAD_LEFT) : $row[0],
                    'FullName' => $row[1],
                    'Amount' => is_null($row[2]) ? 0 : $row[2],
                ]);
            }
            $index++;
        });
    }
}
