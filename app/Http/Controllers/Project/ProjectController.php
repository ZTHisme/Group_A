<?php

namespace App\Http\Controllers\Project;

use App\Contracts\Services\Project\ProjectServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Employee;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    /**
     * project service interface
     */
    private $projectInterface;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProjectServiceInterface $projectServiceInterface)
    {
        $this->projectInterface = $projectServiceInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = $this->projectInterface->getProjects();

        return view('projects.index')
            ->with(['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCreateView()
    {
        // Check user has manager access or not.
        if (Gate::denies('isManager')) {
            abort(401);
        }

        $employees = $this->projectInterface->getEmployee();

        return view('projects.create')
            ->with(['employees' => $employees]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreate(StoreProjectRequest $request)
    {
        // Check user has manager access or not.
        if (Gate::denies('isManager')) {
            abort(401);
        }

        $project = $this->projectInterface->storeProject($request);

        Session::flash('success', 'Project Created Successfully.');

        if ($project) {
            return response()->json([
                'result' => 1,
            ]);
        } else {
            return response()->json([
                'result' => 0,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @param App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function getMembers(Project $project)
    {
        $members = $project->employees;
        $nonMembers = Employee::all()->diff($members);
        $members = $members->pluck('id');
        $nonMembers = $nonMembers->pluck('id');
        dd($nonMembers);
    }
}
