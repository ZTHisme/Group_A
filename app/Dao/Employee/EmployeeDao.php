<?php

namespace App\Dao\Employee;

use App\Contracts\Dao\Employee\EmployeeDaoInterface;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;


/**
 * Data Access Object for Employee
 */
class EmployeeDao implements EmployeeDaoInterface
{
    /**
     * To get employee lists
     * @return $array of employee
     */
    public function getEmployee()
    {
        return Employee::with('role', 'department')->orderBy('created_at', 'asc')->get();
    }
    /**
     * To search employee lists
     * @return $array of employee
     */
    public function searchEmployee(Request $request)
    {
        $name = $request->name;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $employees = DB::table('employees')
            ->join('mst_roles', 'employees.role_id', '=', 'mst_roles.id')
            ->join('mst_departments', 'employees.department_id', '=', 'mst_departments.id')
            ->whereNull('employees.deleted_at')
            ->select('employees.*', 'mst_roles.name as role', 'mst_departments.name as department');
        if ($name) {
            $employees->where('employees.name', 'LIKE', '%' . $name . '%');
        }
        if ($start_date) {
            $employees->whereDate('employees.created_at', '>=', $start_date);
        }
        if ($end_date) {
            $employees->whereDate('employees.created_at', '<=', $end_date);
        }
        return $employees->get()->except('employees.deleted_at');
    }
}
