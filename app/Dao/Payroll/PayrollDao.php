<?php

namespace App\Dao\Payroll;

use App\Models\Employee;
use App\Models\MstCalender;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Contracts\Dao\Payroll\PayrollDaoInterface;
use App\Models\FinalSalary;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Facades\Storage;

/**
 * Data Access Object for Payroll
 */
class PayrollDao implements PayrollDaoInterface
{
    /**
     * To get employee lists
     * 
     * @param Illuminate\Http\Request $request
     * @return $array of employee
     */
    public function getEmployee(Request $request)
    {
        return Employee::with('role', 'department', 'salary')->orderBy('created_at', 'asc')->get();
    }

    /**
     * To get employee lists
     * 
     * @param App\Models\Employee
     * @return fintal salary object
     */
    public function calculate(Employee $employee)
    {
        // Actual working days for this month.
        $monthlyWorkingDays = MstCalender::select('working_days')
            ->where('month', Carbon::now()->month)
            ->where('year', Carbon::now()->year)
            ->first()
            ->working_days;

        $calculatedPayroll = $employee->finalsalaries()
            ->where('month', Carbon::now()->month)
            ->where('year', Carbon::now()->year)
            ->first();

        // Check payroll for this month is already calculated or not.
        if ($calculatedPayroll) {
            $calculatedPayroll->load('employee', 'employee.role', 'employee.department');
            return [
                'monthlyWorkingDays' => $monthlyWorkingDays,
                'calculatedPayroll' => $calculatedPayroll
            ];
        } else {
            $basicSalaryPerHours = ($employee->salary->basic_salary / $monthlyWorkingDays)
                / config('constants.Actual_Working_Hours');

            $emptotalWorkingHours = $employee->attendances()
                ->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->whereNotNull('working_hours')
                ->sum('working_hours');

            $calculated['empOfficialHours'] = ($emptotalWorkingHours + ($employee->leave_days *
                config('constants.Actual_Working_Hours'))) - $employee->overtimes;

            $calculated['totalLeaveFines'] = $employee->leave_days * $employee->salary->leave_fine;
            $calculated['totalOverTimeFees'] = $employee->overtimes * $employee->salary->overtime_fee;
            $calculated['finalSalary'] = (($calculated['empOfficialHours'] * $basicSalaryPerHours)
                + $calculated['totalOverTimeFees']) - $calculated['totalLeaveFines'];
            $calculated['filePath'] = 'payroll' . config('path.separator') . Carbon::now()->month . '_'
                . Carbon::now()->year . config('path.separator') . $employee->name . '_payroll.pdf';

            $payroll = DB::transaction(function () use ($employee, $calculated) {
                return $employee->finalsalaries()
                    ->create([
                        'year' => Carbon::now()->year,
                        'month' => Carbon::now()->month,
                        'total_leave_days' => $employee->leave_days,
                        'total_leave_fines' => round($calculated['totalLeaveFines'], 2),
                        'total_overtimes' => round($employee->overtimes, 1),
                        'total_overtime_fees' => round($calculated['totalOverTimeFees'], 2),
                        'total_working_hours' => round($calculated['empOfficialHours'], 1),
                        'salary' => round($calculated['finalSalary'], 2),
                        'file' => $calculated['filePath']
                    ]);
            }, 5);

            $payroll->load('employee', 'employee.role', 'employee.department');
            $pdf = PDF::loadView('pdf.payroll', [
                'monthlyWorkingDays' => $monthlyWorkingDays,
                'calculatedPayroll' => $payroll
            ]);
            Storage::put($calculated['filePath'], $pdf->output());

            return [
                'monthlyWorkingDays' => $monthlyWorkingDays,
                'calculatedPayroll' => $payroll
            ];
        }
    }

    /**
     * To calculate pay roll
     * 
     * @param App\Models\Employee $employee
     * @return $array of employee
     */
    public function recalculate(Employee $employee)
    {
        // Actual working days for this month.
        $monthlyWorkingDays = MstCalender::select('working_days')
            ->where('month', Carbon::now()->month)
            ->where('year', Carbon::now()->year)
            ->first()
            ->working_days;

        $calculatedPayroll = $employee->finalsalaries()
            ->where('month', Carbon::now()->month)
            ->where('year', Carbon::now()->year)
            ->first();

        $basicSalaryPerHours = ($employee->salary->basic_salary / $monthlyWorkingDays)
            / config('constants.Actual_Working_Hours');

        $calculated['emptotalWorkingHours'] = $employee->attendances()
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->whereNotNull('working_hours')
            ->sum('working_hours');

        $empOfficialHours = ($calculated['emptotalWorkingHours'] + ($employee->leave_days *
            config('constants.Actual_Working_Hours'))) - $employee->overtimes;

        $calculated['totalLeaveFines'] = $employee->leave_days * $employee->salary->leave_fine;
        $calculated['totalOverTimeFees'] = $employee->overtimes * $employee->salary->overtime_fee;
        $calculated['finalSalary'] = (($empOfficialHours * $basicSalaryPerHours)
            + $calculated['totalOverTimeFees']) - $calculated['totalLeaveFines'];
        $calculated['filePath'] = 'payroll' . config('path.separator') . Carbon::now()->month . '_'
            . Carbon::now()->year . config('path.separator') . $employee->name . '_payroll.pdf';

        DB::transaction(function () use ($employee, $calculatedPayroll, $calculated) {
            $calculatedPayroll->update([
                'year' => Carbon::now()->year,
                'month' => Carbon::now()->month,
                'total_leave_days' => $employee->leave_days,
                'total_leave_fines' => round($calculated['totalLeaveFines'], 2),
                'total_overtimes' => round($employee->overtimes, 1),
                'total_overtime_fees' => round($calculated['totalOverTimeFees'], 2),
                'total_working_hours' => round($calculated['emptotalWorkingHours'], 1),
                'salary' => round($calculated['finalSalary'], 2),
                'file' => $calculated['filePath']
            ]);
        }, 5);

        $calculatedPayroll->load('employee', 'employee.role', 'employee.department');
        $pdf = PDF::loadView('pdf.payroll', [
            'monthlyWorkingDays' => $monthlyWorkingDays,
            'calculatedPayroll' => $calculatedPayroll
        ]);
        Storage::put($calculated['filePath'], $pdf->output());

        return [
            'monthlyWorkingDays' => $monthlyWorkingDays,
            'calculatedPayroll' => $calculatedPayroll
        ];
    }
}
