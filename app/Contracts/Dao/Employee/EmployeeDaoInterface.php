<?php

namespace App\Contracts\Dao\Employee;

use Illuminate\Http\Request;
use App\Models\Employee;


/**
 * Interface for Data Accessing Object of employee
 */
interface EmployeeDaoInterface
{
    /**
     * To search employee lists
     * 
     * @param Illuminate\Http\Request $request
     * @return $array of employee
     */
    public function searchEmployee(Request $request);

    /**
     * To show graph
     * @return $array of employee
     */
    public function showPieGraph();

    /**
     * To show bar graph
     * @return $array of employee
     */
    public function showBarGraph();
}
