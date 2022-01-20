<?php

namespace App\Services\Employee;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Contracts\Dao\Employee\EmployeeDaoInterface;
use App\Contracts\Services\Employee\EmployeeServicesInterface;
use Illuminate\Support\Facades\Storage;

/**
 * Service class for task.
 */
class EmployeeService implements EmployeeServicesInterface
{
    /**
     * task dao
     */
    private $employeeDao;
    /**
     * Class Constructor
     * @param EmployeeDaoInterface
     * @return
     */
    public function __construct(EmployeeDaoInterface $employeeDao)
    {
        $this->employeeDao = $employeeDao;
    }

    /**
     * To get employee lists
     * @return $array of employee
     */
    public function getEmployee()
    {
        return $this->employeeDao->getEmployee();
    }

    /**
     * To get list of roles
     *  @param
     *  @return $roles
     */
    public function getRoles()
    {
        $roles = $this->employeeDao->getRoles();
        return $roles;
    }

    /**
     * To get list of departs
     *  @param
     *  @return $departs
     */
    public function getDepartments()
    {
        $departments = $this->employeeDao->getDepartments();
        return $departments;
    }

    /**
     * To add new employee
     * @param Request $request
     * @return
     */
    public function addEmployee(Request $request)
    {
        $employee = $this->employeeDao->addEmployee($request);
        Mail::send('newEmployeeMail', ['employee_name' => $request->name], function ($message) use ($request) {
            $message->to($request->email, 'New Employee')->subject('Registration Information');
        });

        //Storage::move(
        //    config('path.public_tmp') . $request['profile'],
        //    config('path.profile') . $employee->id . config('path.separator') . $request['profile']
        //);

        return $employee;
    }

    /**
     * To get all employee list
     * @param
     * @return $employees
     */
    public function getAllEmployees()
    {
        $employees = $this->employeeDao->getAllEmployees();
        return $employees;
    }

    /**
     * To get a employee by id
     * @param $id
     * @return Object $employee
     */
    public function getEmployeeById($id)
    {
        $employee = $this->employeeDao->getEmployeeById($id);
        return $employee;
    }

    /**
     * To edit emplyee information
     * @param $id,Request $request
     * @return
     */
    public function editEmployeeById(Request $request, $id)
    {
        $this->employeeDao->editEmployeeById($request, $id);
        return true;
    }

    /**
     * To delete employee by id
     * @param $id
     * @return
     */
    public function deleteEmployeeById($id)
    {
        $this->employeeDao->deleteEmployeeById($id);
        return true;
    }
}
