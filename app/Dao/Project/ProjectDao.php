<?php

namespace App\Dao\Project;

use App\Contracts\Dao\Project\ProjectDaoInterface;
use App\Models\Employee;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Data Access Object for Payroll
 */
class ProjectDao implements ProjectDaoInterface
{
    /**
     * To get all projects
     * 
     * @return $array of projects
     */
    public function getProjects()
    {
        return Project::with('manager')
            ->withCount('employees')
            ->latest()
            ->get();
    }

    /**
     * To get all employees
     * 
     * @return $array of employee
     */
    public function getEmployee()
    {
        return Employee::where('role_id', '<>', config('constants.Manager'))
            ->latest()
            ->get()
            ->pluck('name', 'id');
    }

    /**
     * To store project
     * 
     * @param Illuminate\Http\Request $request
     * @return bool
     */
    public function storeProject(Request $request)
    {
        $project = DB::transaction(function () use ($request) {
            $project = Project::create([
                'name' => $request->name,
                'link' => $request->link,
                'manager_id' => auth()->id()
            ]);

            foreach ($request->employees as $employee) {
                $project->employees()->attach($employee);
            }

            return $project;
        }, 5);

        return $project;
    }
}
