<?php

namespace App\Contracts\Services\Employee;

use App\Models\Employee;
use Illuminate\Http\Request;

/**
 * Interface for Employee service
 */
interface EmployeeServiceInterface
{
    /**
     * To search employee lists
     * 
     * @param Illuminate\Http\Request $request
     * @return $array of employee
     */
    public function searchEmployee(Request $request);

    /**
     * To show pie graph
     * @return $array of employee
     */
    public function showPieGraph();

    /**
     * To show bar graph
     * @return $array of employee
     */
    public function showBarGraph();

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

    /**
     * To upload csv file
     * @return File upload csv
     */
    public function uploadCSV();
}
