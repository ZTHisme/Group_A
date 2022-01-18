<?php

namespace App\Contracts\Dao\Attendance;

use Illuminate\Http\Request;
use App\Models\Attendance;

/**
 * Interface for Data Accessing Object of attendance
 */
interface AttendanceDaoInterface
{
    /**
     * To get attendance lists
     * @return $array of attendances
     */
    public function getAttendances();

    /**
     * To store daily attendance record
     * @return attendance object
     */
    public function saveAttendance(Request $request);

    /**
     * To update daily attendance record
     * @return attendance object
     */
    public function updateAttendance();
}
