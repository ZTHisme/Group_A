<?php

namespace App\Contracts\Services\Payroll;

use App\Models\Employee;
use App\Models\FinalSalary;
use Illuminate\Http\Request;

/**
 * Interface for Payroll service
 */
interface PayrollServiceInterface
{
    /**
     * To get employee lists
     * 
     * @param Illuminate\Http\Request $request
     * @return $array of employee
     */
    public function getEmployee(Request $request);

    /**
     * To calculate pay roll
     * 
     * @param App\Models\Employee $employee
     * @return $array of employee
     */
    public function calculate(Employee $employee);

    /**
     * To calculate pay roll
     * 
     * @param App\Models\Employee $employee
     * @return $array of employee
     */
    public function recalculate(Employee $employee);

    /**
     * Sending mail to employee.
     *
     * @param App\Models\FinalSalary $finalSalary
     * @return bool
     */
    public function sendPayrollMail(FinalSalary $finalsalary);

    /**
     * To update employee payroll
     * 
     * @param Illuminate\Http\Request $request
     * @param App\Models\Employee $employee
     * @return $employee object
     */
    public function updatePayroll(Request $request, Employee $employee);
}
