<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use Illuminate\Support\Carbon;

class Attendance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id',
        'working_hours',
        'leave',
        'type',
        'overtime'
    ];

    /**
     * Get the employee that owns the attendance.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Get the attendance's type name.
     *
     * @return string
     */
    public function getTypeNameAttribute()
    {
        return $this->type == config('constants.WFH') ? 'WFH' : 'Office';
    }

    /**
     * Get the employee's attendance status.
     *
     * @return string
     */
    public function getStatusAttribute()
    {
        $attendance = Employee::findOrFail(1)
                ->attendances()
                ->whereDate('created_at', Carbon::today())
                ->where('leave', 0)
                ->first();
        return $attendance ? 'Present' : 'Absent';
    }
}
