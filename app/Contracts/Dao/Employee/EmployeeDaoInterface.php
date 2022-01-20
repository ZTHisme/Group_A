<?php

namespace App\Contracts\Dao\Employee;

use Illuminate\Http\Request;

/**
 * Interface for Data Accessing Object of Post
 */
interface EmployeeDaoInterface
{
    /**
     * To get all employee list
     * @param
     * @return $employees
     */
    public function getAllEmployees();

    /**
     * To get employee lists
     * @return $array of employee
     */
    public function getEmployee();

    /**
     * To get list of roles
     *  @param
     *  @return $roles
     */
    public function getRoles();

    /**
     * To get list of departs
     *  @param
     *  @return $departs
     */
    public function getDepartments();

    /**
     * To add new employee
     * @param Request $request
     * @return
     */
    public function addEmployee(Request $request);

    /**
     * To get a employee by id
     * @param $id
     * @return Object $employee
     */
    public function getEmployeeById($id);

    /**
     * To edit employee information
     * @param $id,Request $request
     * @return
     */
    public function editEmployeeById(Request $request, $id);

    /**
     * To delete employee by id
     * @param $id
     * @return
     */
    public function deleteEmployeeById($id);
}
