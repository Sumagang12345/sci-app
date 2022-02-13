<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class EmployeeDeductions extends Model
{
    use HasFactory, Uuids;
    protected $fillable = ['employee_id', 'fullname', 'amount'];
}
