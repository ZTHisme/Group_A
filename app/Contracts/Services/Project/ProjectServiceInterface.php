<?php

namespace App\Contracts\Services\Project;

use Illuminate\Http\Request;

/**
 * Interface for Payroll service
 */
interface ProjectServiceInterface
{
    /**
     * To get all projects
     * 
     * @return $array of projects
     */
    public function getProjects();

    /**
     * To get all employees
     * 
     * @return $array of employee
     */
    public function getEmployee();

    /**
     * To store project
     * 
     * @param Illuminate\Http\Request $request
     * @return bool
     */
    public function storeProject(Request $request);
}
