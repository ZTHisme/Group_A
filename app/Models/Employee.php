<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Salary;

class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'profile',
        'role_id',
        'department_id',
        //'created_user_id',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the role that owns the employee.
     */
    public function role()
    {
        return $this->belongsTo(MstRole::class);
    }

    /**
     * Get the department that owns the employee.
     */
    public function department()
    {
        return $this->belongsTo(MstDepartment::class);
    }

    /**
     * Get the salary associated with the employee.
     */
    public function salary()
    {
        return $this->hasOne(Salary::class);
    }

    /**
     * Get the final salaries for the employee.
     */
    public function finalsalaries()
    {
        return $this->hasMany(FinalSalary::class);
    }

    /**
     * Get the attendance for the employee.
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
