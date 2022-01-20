<?php

namespace App\Http\Controllers\Employee;

use App\Contracts\Services\Employee\EmployeeServiceInterface;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Employee;

use Illuminate\Support\Facades\DB;

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
        return view('employee.index', compact('employees'));
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
