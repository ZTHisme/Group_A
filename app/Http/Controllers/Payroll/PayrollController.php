<?php

namespace App\Http\Controllers\Payroll;

use App\Contracts\Services\Payroll\PayrollServiceInterface;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\FinalSalary;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    /**
     * task interface
     */
    private $payrollInterface;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PayrollServiceInterface $payrollServiceInterface)
    {
        $this->payrollInterface = $payrollServiceInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employees = $this->payrollInterface->getEmployee($request);

        return view('payrolls.index')
            ->with(['employees' => $employees]);
    }

    /**
     * Calculate the payroll of employee.
     *
     * @param App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function calculate(Employee $employee)
    {
        $data = $this->payrollInterface->calculate($employee);

        return view('payrolls.calculate')
            ->with($data);
    }

    /**
     * Recalculate the payroll of employee.
     *
     * @param App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function recalculate(Employee $employee)
    {
        $data = $this->payrollInterface->recalculate($employee);

        return view('payrolls.calculate')
            ->with($data);
    }

    /**
     * Sending mail to employee.
     *
     * @param App\Models\FinalSalary $finalSalary
     * @return \Illuminate\Http\Response
     */
    public function sendPayrollMail(FinalSalary $finalsalary)
    {
        if ($this->payrollInterface->sendPayrollMail($finalsalary)) {
            return redirect()
                ->route('payrolls#index')
                ->with('success', 'Email has been sent.');
        }
    }
}
