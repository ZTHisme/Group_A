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
     * @return $array of employee
     */
    public function searchEmployee(Request $request);
}
