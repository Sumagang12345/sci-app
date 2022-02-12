<?php

namespace Database\Seeders;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = ['1001','1002','1003','1004','1005'];
        $b = ['SUMAGANG, BEN VICTOR LAGUNA','PALOMAR, EDCEL MARK SARIM','BONGABONG, DARIEL CUARTERO','CUARTERO, MARIO REBUERA','VISTAL, CHRISTOPHER PLATINO'];
        for($i=0; $i<=4; $i++){
            Employee::create([
                'EmployeeID' => $a[$i],
                'FullName' => $b[$i],
                'Amount' => 0,
            ]);
        }
    }
}
