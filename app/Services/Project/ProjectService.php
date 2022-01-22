<?php

namespace App\Services\Project;

use App\Contracts\Dao\Project\ProjectDaoInterface;
use App\Contracts\Services\Project\ProjectServiceInterface;
use Illuminate\Http\Request;

/**
 * Service class for Project
 */
class ProjectService implements ProjectServiceInterface
{
    /**
     * Project dao
     */
    private $projectDao;
    /**
     * Class Constructor
     * @param payrollDaoInterface
     * @return
     */
    public function __construct(ProjectDaoInterface $projectDao)
    {
        $this->projectDao = $projectDao;
    }
    
    /**
     * To get all employees
     * 
     * @return $array of employee
     */
    public function getEmployee()
    {
        return $this->projectDao->getEmployee();
    }

     /**
     * To store project
     * 
     * @param Illuminate\Http\Request $request
     * @return bool
     */
    public function storeProject(Request $request)
    {
        return $this->projectDao->storeProject($request);
    }
}
