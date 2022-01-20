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
