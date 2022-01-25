<?php

namespace App\Contracts\Dao\Schedule;

use App\Models\Project;
use App\Models\Schedule;
use Illuminate\Http\Request;

/**
 * Interface for Data Accessing Object of Schedule
 */
interface ScheduleDaoInterface
{
    /**
     * To store schedule
     * 
     * @param \App\Models\Project $project
     * @param Illuminate\Http\Request $request
     * @return bool
     */
    public function storeSchedule(Request $request, Project $project);
}
