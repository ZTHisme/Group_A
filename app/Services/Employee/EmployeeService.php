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
     * To get list of roles
     *  @return $roles
     */
    public function getRoles()
    {
        $roles = $this->employeeDao->getRoles();
        return $roles;
    }

    /**
     * To get list of departs
     *  
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
        return $this->employeeDao->addEmployee($request);

        //Storage::move(
        //    config('path.public_tmp') . $request['profile'],
        //    config('path.profile') . $employee->id . config('path.separator') . $request['profile']
        //);

        return $employee;
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
        return $this->employeeDao->editEmployeeById($request, $id);
    }

    /**
     * To delete employee by id
     * @param $id
     * @return
     */
    public function deleteEmployeeById($id)
    {
        return $this->employeeDao->deleteEmployeeById($id);
    }

    /*
     * To search employee lists
     * 
     * @param Illuminate\Http\Request $request
     * @return $array of employee
     */
    public function searchEmployee(Request $request)
    {
        return $this->employeeDao->searchEmployee($request);
    }

    /**
     * To show pie graph
     * @return $array of employee
     */
    public function showPieGraph()
    {
        $record = $this->employeeDao->showPieGraph();

        $data = [];
        foreach ($record as $row) {
            $data['label'][] = $row->department_name;
            $data['data'][] = (int) $row->count;
        }
        $data['chart_data'] = json_encode($data);

        return $data;
    }

    /**
     * To show bar graph
     * @return $array of employee
     */
    public function showBarGraph()
    {
        $barrecord = $this->employeeDao->showBarGraph();

        $bardata = [];
        foreach ($barrecord as $row) {
            $bardata['label'][] = $row->department_name;
            $bardata['data'][] = (int) $row->count;
        }
        $bardata['barchart_data'] = json_encode($bardata);

        return $bardata;
    }
}
