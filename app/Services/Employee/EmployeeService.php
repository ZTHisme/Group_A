<?php

namespace App\Services\Employee;

use App\Contracts\Dao\Employee\EmployeeDaoInterface;
use App\Contracts\Services\Employee\EmployeeServiceInterface;
use App\Models\Employee;
use Illuminate\Http\Request;


/**
 * Service class for employee
 */
class EmployeeService implements EmployeeServiceInterface
{
    /**
     * employee dao
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
     * To search employee lists
     * @return $array of employee
     */
    public function searchEmployee(Request $request)
    {
        return $this->employeeDao->searchEmployee($request);
    }
}
