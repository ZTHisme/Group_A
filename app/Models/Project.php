<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'link',
        'manager_id'
    ];

    /**
     * The employees that belong to the project.
     */
    public function employees()
    {
        return $this->belongsToMany(Employee::class)->withTimeStamps();
    }

    /**
     * Get the schedules for the project.
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
