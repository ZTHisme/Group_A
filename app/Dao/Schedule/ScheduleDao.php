<?php

namespace App\Dao\Schedule;

use App\Contracts\Dao\Schedule\ScheduleDaoInterface;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;

/**
 * Data Access Object for Schedule
 */
class ScheduleDao implements ScheduleDaoInterface
{
    /**
     * To store schedule
     * 
     * @param \App\Models\Project $project
     * @param Illuminate\Http\Request $request
     * @return bool
     */
    public function storeSchedule(Request $request, Project $project)
    {
        try {
            DB::beginTransaction();

            if ($file = $request->file('file')) {
                $schedule = $project->schedules()
                    ->create([
                        'name' => $request->name,
                        'description' => $request->description,
                        'start_date' => $request->start_date,
                        'end_date' => $request->end_date,
                        'file' => $request->name . time() . '.' . $file->clientExtension(),
                        'status' => config('constants.Not_Started'),
                        'assignor_id' => auth()->id(),
                        'assignee_id' => $request->assignee_id
                    ]);
            } else {
                $schedule = false;
            }

            DB::commit();
            return $schedule;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}