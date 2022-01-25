<?php

namespace App\Http\Controllers\Schedule;

use App\Contracts\Services\Schedule\ScheduleServiceInterface;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ScheduleController extends Controller
{
    /**
     * schedule service interface
     */
    private $scheduleInterface;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ScheduleServiceInterface $scheduleServiceInterface)
    {
        $this->scheduleInterface = $scheduleServiceInterface;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function scheduleCreateView(Project $project)
    {
        // Check user is project manager or senior.
        if (Gate::denies('create-task', $project)) {
            abort(401);
        }

        return view('schedules.create')
            ->with(['project' => $project]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Models\Project $project
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSchedule(Request $request, Project $project)
    {
        // Check user is project manager or senior.
        if (Gate::denies('create-task', $project)) {
            abort(401);
        }

        $schedule = $this->scheduleInterface->storeSchedule($request, $project);

        if ($schedule) {
            return redirect()
                ->route('projects#showDetail', [$project->id])
                ->with('success', 'Schdule Updated Successfully.');
        } else {
            return back()
                ->withErrors('Unknown error occured.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
