<?php

namespace App\Services\Payroll;

use App\Models\Employee;
use App\Models\FinalSalary;
use Illuminate\Http\Request;
use App\Contracts\Dao\Payroll\PayrollDaoInterface;
use App\Contracts\Services\Payroll\PayrollServiceInterface;
use App\Jobs\SendPayrollMailJob;
use App\Mail\EmployeePayroll;
use Mail;

/**
 * Service class for employee
 */
class PayrollService implements PayrollServiceInterface
{
    /**
     * employee dao
     */
    private $payrollDao;
    /**
     * Class Constructor
     * @param payrollDaoInterface
     * @return
     */
    public function __construct(PayrollDaoInterface $payrollDao)
    {
        $this->payrollDao = $payrollDao;
    }

    /**
     * To get employee lists
     * 
     * @param Illuminate\Http\Request $request
     * @return $array of employee
     */
    public function getEmployee(Request $request)
    {
        return $this->payrollDao->getEmployee($request);
    }

    /**
     * To calculate pay roll
     * 
     * @param App\Models\Employee $employee
     * @return $array of employee
     */
    public function calculate(Employee $employee)
    {
        return $this->payrollDao->calculate($employee);
    }

    /**
     * To calculate pay roll
     * 
     * @param App\Models\Employee $employee
     * @return $array of employee
     */
    public function recalculate(Employee $employee)
    {
        return $this->payrollDao->recalculate($employee);
    }

    /**
     * Sending mail to employee.
     *
     * @param App\Models\FinalSalary $finalSalary
     * @return bool
     */
    public function sendPayrollMail(FinalSalary $finalsalary)
    {
        dispatch(new SendPayrollMailJob($finalsalary));
        // Check mail sending process has error.
        if (count(Mail::failures()) > 0) {
            Log::error('Mail Sending Error', Mail::failures());
        } else {
            return true;
        }
    }

    /**
     * To update employee payroll
     * 
     * @param Illuminate\Http\Request $request
     * @param App\Models\Employee $employee
     * @return $employee object
     */
    public function updatePayroll(Request $request, Employee $employee)
    {
        return $this->payrollDao->updatePayroll($request, $employee);
    }
}
