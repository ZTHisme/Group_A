<?php

namespace App\Http\Controllers\Attendance;

use App\Contracts\Services\Attendance\AttendanceServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttendanceRequest;

class AttendanceController extends Controller
{
    /**
     * attendance interface
     */
    private $attendanceInterface;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AttendanceServiceInterface $attendanceServiceInterface)
    {
        $this->attendanceInterface = $attendanceServiceInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendances = $this->attendanceInterface->getAttendances();

        return view('attendances.index')
            ->with(['attendances' => $attendances]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAttendanceRequest $request)
    {
        $result = $this->attendanceInterface->saveAttendance($request);

        if ($result) {
            return redirect()
                ->route('attendances#index')
                ->with('success', 'Your attendance info has been recorded.');
        } else {
            return back()
                ->withErrors('You have already checked in.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $result = $this->attendanceInterface->updateAttendance();

        if ($result) {
            return redirect()
                ->route('attendances#index')
                ->with('success', 'Your attendance for today has been recorded successfully.');
        } else {
            return back()
                ->withErrors('You have already checked out or you may have taken leave.');
        }
    }
}
