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
        $b = ['BEN VICTOR','EDCEL MARK','DARIEL','MARIO','CHRISTOPHER'];
        $c = ['SUMAGANG','PALOMAR','BONGABONG','CUARTERO','VISTAL'];
        $d = ['LAGUNA','SARIM','CUARTERO','REBUERA','PLATINO'];
        for($i=0; $i<=4; $i++){
            Employee::create([
                'EmployeeID' => $a[$i],
                'Firstname' => $b[$i],
                'Lastname' => $c[$i],
                'Middlename' => $d[$i],
            ]);
        }
    }
}
