<?php

namespace App\Http\Controllers\Employee;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Contracts\Services\Employee\EmployeeServiceInterface;
use App\Http\Requests\EditEmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * task interface
     */
    private $employeeInterface;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EmployeeServiceInterface $employeeServiceInterface)
    {
        $this->employeeInterface = $employeeServiceInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employees = $this->employeeInterface->searchEmployee($request);
        return view('Employee.index', compact('employees'));
    }

    /**
     * To redirect new employee information form
     * @param
     * @return view
     */
    public function showEmploeeForm()
    {
        $roles = $this->employeeInterface->getRoles();
        $departments = $this->employeeInterface->getDepartments();

        return view('Employee.employeeCreate')->with(['roles' => $roles, 'departments' => $departments]);
    }

    /**
     * To save new employee
     * 
     * @param App\Http\Requests\StoreEmployeeRequest $request
     * @return massage success or not
     */
    public function submitEmployeeForm(StoreEmployeeRequest $request)
    {
        $employee = $this->employeeInterface->addEmployee($request);

        if ($employee) {
            return redirect()
                ->route('employee#showLists')
                ->with('success', 'Employee created successfully.');
        } else {
            return back()
                ->withErrors('Unknown error occured! Please try again.');
        }
    }

    /**
     * To redirect student edit information form
     * @param
     * @return view
     */
    public function showEmployeeDetailForm($id)
    {
        $employee = $this->employeeInterface->getEmployeeById($id);
        return view('Employee.employeeShow')->with(['employee' => $employee]);
    }

    /**
     * To redirect student edit information form
     * @param $id
     * @return view
     */
    public function showEmployeeEditForm($id)
    {
        $roles = $this->employeeInterface->getRoles();
        $departments = $this->employeeInterface->getDepartments();

        $employee = $this->employeeInterface->getEmployeeById($id);
        return view('Employee.employeeEdit')
            ->with(['employee' => $employee, 'roles' => $roles, 'departments' => $departments]);
    }

    /**
     * To update student information
     * @param App\Http\Requests\StoreEmployeeRequest $request
     * @param $id
     * @return message success or not
     */
    public function submitEmployeeEditForm(EditEmployeeRequest $request, $id)
    {
        $employee = $this->employeeInterface->editEmployeeById($request, $id);

        if ($employee) {
            return redirect()
                ->route('employee#showLists')
                ->with('success', 'Employee data is updated successfully.');
        } else {
            return back()
                ->withErrors('Unknown error occured! Please try again.');
        }
    }

    /**
     * To delete student by id
     * @param student id
     * @return message success or not
     */
    public function deleteEmployee($id)
    {
        $employee = $this->employeeInterface->deleteEmployeeById($id);

        if ($employee) {
            return redirect()
                ->route('employee#showLists')
                ->with('success', 'Employee data is deleted successfully.');
        } else {
            return back()
                ->withErrors('Unknown error occured! Please try again.');
        }
    }

    /**
     * Display chart data.
     *
     * @return \Illuminate\Http\Response
     */
    public function graph()
    {
        $data = $this->employeeInterface->showPieGraph();
        $bardata = $this->employeeInterface->showBarGraph();
        return view('dashboard.index', $data, $bardata);
    }
}
