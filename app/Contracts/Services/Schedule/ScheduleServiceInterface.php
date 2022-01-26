<?php

namespace App\Contracts\Services\Schedule;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Schedule;

/**
 * Interface for Schedule service
 */
interface ScheduleServiceInterface
{
    /**
     * To store schedule
     * 
     * @param App\Models\Project $project
     * @param Illuminate\Http\Request $request
     * @return bool
     */
    public function storeSchedule(Request $request, Project $project);
}
