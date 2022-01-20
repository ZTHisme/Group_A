<?php

namespace App\Http\Controllers\Employee;

use App\Contracts\Services\Employee\EmployeeServicesInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditEmployeeRequest;
use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Employee;
use Illuminate\Auth\Events\Validated;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    private $employeeInterface;

    /**
     * Class Constructor
     * @param EmployeeServicesInterface
     * @return
     */
    public function __construct(EmployeeServicesInterface $employeeServicesInterface)
    {
        $this->employeeInterface = $employeeServicesInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employees = $this->employeeInterface->getEmployee();
        //$employees = $this->employeeInterface->searchEmployee($request);
        return view('Employee.index', compact('employees'));
    }

    /**
     * To get all employee list
     * @param
     * @return $employees
     */
    public function showEmployeeList()
    {
        $employees = $this->employeeInterface->getEmployee();
        return view('Employee.index', compact('employees'));
        //return view('Employee.index')->with(['employees' => $employees]);
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
     * @param Request $request
     * @return massage success or not
     */
    public function submitEmployeeForm(StoreEmployeeRequest $request)
    {
        dd($request);

        $validated = $request->validated();
        $this->employeeInterface->addEmployee($request, $validated);
        return redirect()->route('employee#showLists')
            //->withInput()
            //->with('profileName', $profile['name'])
            //->with('profilePath', $profile['path'])
            ->with(['successMessage' => 'The new employee is added successfully!']);
    }

    /**
     * To redirect student edit information form
     * @param
     * @return view
     */
    public function showEmployeeDetailForm($id)
    {
        $roles = $this->employeeInterface->getRoles();
        $departments = $this->employeeInterface->getDepartments();

        $employee = $this->employeeInterface->getEmployeeById($id);
        return view('Employee.employeeShow')->with(['employee' => $employee, 'roles' => $roles, 'departments' => $departments]);
    }

    /**
     * To redirect student edit information form
     * @param
     * @return view
     */
    public function showEmployeeEditForm($id)
    {
        $roles = $this->employeeInterface->getRoles();
        $departments = $this->employeeInterface->getDepartments();

        $employee = $this->employeeInterface->getEmployeeById($id);
        return view('Employee.employeeEdit')->with(['employee' => $employee, 'roles' => $roles, 'departments' => $departments]);
    }

    /**
     * To update student information
     * @param student id, Request $request
     * @return message success or not
     */
    public function submitEmployeeEditForm(Request $request, $id)
    {
        //$validated = $request->validated();
        $this->employeeInterface->editEmployeeById($request, $id);
        return redirect()->route('employee#showLists')->with(['successMessage' => 'The employee data is updated successfully!']);
    }

    /**
     * To delete student by id
     * @param student id
     * @return message success or not
     */
    public function deleteEmployee($id)
    {
        $this->employeeInterface->deleteEmployeeById($id);
        return redirect()->route('employee#showLists')->with(['deleteMessage' => 'The employee record is deleted successfully!']);
    }
}
