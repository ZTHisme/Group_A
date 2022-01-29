<?php

namespace App\Dao\Attendance;

use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Contracts\Dao\Attendance\AttendanceDaoInterface;
use Illuminate\Support\Facades\DB;

/**
 * Data Access Object for attendance
 */
class AttendanceDao implements AttendanceDaoInterface
{
    /**
     * To get attendance lists
     * @return $array of attendances
     */
    public function getAttendances()
    {
        $authUser = Attendance::whereDate('created_at', Carbon::today())
            ->where('employee_id', auth()->id())
            ->with('employee.role', 'employee.department', 'employee')
            ->get();

        $sortedAttendances = Attendance::whereDate('created_at', Carbon::today())
            ->where('employee_id', '<>', auth()->id())
            ->with('employee.role', 'employee.department', 'employee')
            ->latest()
            ->get();

        return $authUser->concat($sortedAttendances);
    }

    /**
     * To store daily attendance record
     * @return attendance object
     */
    public function saveAttendance(Request $request)
    {
        $attendance = auth()->user()
            ->attendances()
            ->whereDate('created_at', Carbon::today())
            ->first();

        // Check attendance already exist
        if ($attendance) {
            return false;
        } else {
            $attendance = DB::transaction(function () use ($request) {
                return auth()->user()
                    ->attendances()
                    ->create($request->all());
            }, 5);
            return $attendance;
        }
    }

    /**
     * To update daily attendance record
     * @return attendance object
     */
    public function updateAttendance()
    {
        $attendance = auth()->user()
            ->attendances()
            ->whereDate('created_at', Carbon::today())
            ->where('leave', 0)
            ->whereNull('working_hours')
            ->first();

        if ($attendance) {
            DB::transaction(function () use ($attendance) {
                $workingHours = now()->diffInMinutes($attendance->created_at);
                $workingHours = round($workingHours / 60, 1) - 1;
                $attendance->working_hours = $workingHours;
                if ($workingHours > config('constants.Actual_Working_Hours')) {
                    $overtime = round($workingHours - config('constants.Actual_Working_Hours'), 1);
                    $attendance->overtime = $overtime;
                }
                $attendance->save();
            }, 5);
            return $attendance;
        } else {
            return false;
        }
    }
}
