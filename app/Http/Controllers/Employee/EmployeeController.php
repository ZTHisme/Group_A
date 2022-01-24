<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Exports\EmployeesExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\EditEmployeeRequest;
use App\Http\Requests\StoreEmployeeRequest;
use App\Contracts\Services\Employee\EmployeeServiceInterface;

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
        // Check user has manager access or not.
        if (Gate::denies('isManager')) {
            abort(401);
        }

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
        // Check user has manager access or not.
        if (Gate::denies('isManager')) {
            abort(401);
        }

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
        // Check user own profile or user has manager role.
        if (Gate::denies('update-employee', $id)) {
            abort(401);
        }

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
        // Check user own profile or user has manager role.
        if (Gate::denies('update-employee', $id)) {
            abort(401);
        }

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
        // Check user has manager access or not.
        if (Gate::denies('isManager')) {
            abort(401);
        }

        $result = $this->employeeInterface->deleteEmployeeById($id);

        if ($result) {
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

    /**
     * To download csv file
     * @return File Download CSV file
     */
    public function downloadCSV()
    {
        return Excel::download(new EmployeesExport, 'form.xlsx');
    }
    
    /**
     * Show the form of upload file
     *
     * @return \Illuminate\Http\Response
     */
    public function showUpload()
    {
        return view('employee.upload');
    }

    /**
     * Import the csv file
     * 
     * @param \Illuminate\Http\Request $request 
     * @return \Illuminate\Http\Response
     */
    public function submitUpload(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);

        if ($this->employeeInterface->uploadCSV()) {
            return redirect()
                ->route('employee#showLists')
                ->with('success', 'Successfully Imported CSV File.');
        }
    }

}
