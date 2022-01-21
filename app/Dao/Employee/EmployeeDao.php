<?php

namespace App\Dao\Employee;

use App\Models\Salary;
use App\Models\MstRole;
use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\MstDepartment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Contracts\Dao\Employee\EmployeeDaoInterface;
use Illuminate\Support\Carbon;

class EmployeeDao implements EmployeeDaoInterface
{
    /**
     * To get list of roles
     *  @param
     *  @return $roles
     */
    public function getRoles()
    {
        $roles = MstRole::all();
        return $roles;
    }

    /**
     * To get list of departs
     *  @param
     *  @return $departs
     */
    public function getDepartments()
    {
        $departments = MstDepartment::all();
        return $departments;
    }

    /**
     * To add new employee
     * @param Request $request
     * @return
     */
    public function addEmployee(Request $request, $filename)
    {
        $employee = DB::transaction(function () use ($request, $filename) {
            $employee = new Employee();
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->password = Hash::make($request->password);
            $employee->phone = $request->phone;
            $employee->address = $request->address;
            $employee->profile = $filename;
            $employee->role_id = $request->role_id;
            $employee->created_user_id = auth()->id();
            $employee->department_id = $request->department_id;
            $employee->save();

            $salary = new Salary();
            $salary->employee_id = $request->employee;
            $salary->leave_fine = $request->leave_fine;
            $salary->overtime_fee = $request->overtime_fee;
            $salary->basic_salary = $request->basic_salary;

            $employee->salary()->save($salary);

            return $employee;
        }, 5);

        return $employee;
    }

    /**
     * To get a employee by id
     * @param $id
     * @return Object $employee
     */
    public function getEmployeeById($id)
    {
        return Employee::with('role', 'department')->findOrFail($id);
    }

    /**
     * To edit employee information
     * @param $id,Request $request
     * @return
     */
    public function editEmployeeById(Request $request, $data)
    {
        $employee = DB::transaction(function () use ($request, $data) {
            $employee = Employee::findOrFail($data['id']);

            if ($data['filename']) {
                $employee->profile = $data['filename'];
            }
            $employee->update([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role_id,
                'department_id' => $request->department_id,
                'phone' => $request->phone,
                'address' => $request->address
            ]);

            return $employee;
        }, 5);

        return $employee;
    }

    /**
     * To delete employee by id
     * @param $id
     * @return
     */
    public function deleteEmployeeById($id)
    {
        $employee = DB::transaction(function () use ($id) {
            return Employee::find($id)->delete();
        }, 5);

        return $employee;
    }

    /**
     * To search employee lists
     * 
     * @param Illuminate\Http\Request $request
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
        return $employees->latest()->get()->except('employees.deleted_at');
    }

    /**
     * To show graph
     * @return $array of employee
     */
    public function showPieGraph()
    {
        $record = Attendance::select(DB::raw("COUNT(*) as count"), DB::raw("(mst_departments.name) as department_name"), DB::raw("DAY(attendances.created_at) as day"))
            ->join('employees', 'attendances.employee_id', '=', 'employees.id')
            ->join('mst_departments', 'employees.department_id', '=', 'mst_departments.id')
            ->where('leave', 0)
            ->whereDate('attendances.created_at', Carbon::today())
            ->groupBy('department_name', 'day')
            ->orderBy('day')
            ->get();

        return $record;
    }

    /**
     * To show bar graph
     * @return $array of employee
     */
    public function showBarGraph()
    {
        $barrecord = Attendance::select(DB::raw("COUNT(*) as count"), DB::raw("(mst_departments.name) as department_name"), DB::raw("DAY(attendances.created_at) as day"))
            ->join('employees', 'attendances.employee_id', '=', 'employees.id')
            ->join('mst_departments', 'employees.department_id', '=', 'mst_departments.id')
            ->where('leave', 1)
            ->whereDate('attendances.created_at', Carbon::today())
            ->groupBy('department_name', 'day')
            ->orderBy('day')
            ->get();

        return $barrecord;
    }
}
