<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    protected $fillable = [
        //'employee_id',
        'leave_fine',
        'overtime_fee',
        'basic_salary',


    ];
}
