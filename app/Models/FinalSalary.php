<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalSalary extends Model
{
    use HasFactory;

    /**
     * Get the employee that owns the final salary.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
