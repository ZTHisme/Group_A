<?php

namespace App\Contracts\Services\Employee;

use App\Models\Employee;
use Illuminate\Http\Request;

/**
 * Interface for Employee service
 */
interface EmployeeServiceInterface
{
    /**
     * To get employee lists
     * @return $array of employee
     */
    public function getEmployee();

    /**
     * To search employee lists
     * 
     * @param Illuminate\Http\Request $request
     * @return $array of employee
     */
    public function searchEmployee(Request $request);

    /**
     * To show pie graph
     * @return $array of employee
     */
    public function showPieGraph();

     /**
     * To show bar graph
     * @return $array of employee
     */
    public function showBarGraph();
}
