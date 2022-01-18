<?php

namespace App\Providers;

use App\Models\Employee;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Dao Registration
        $this->app->bind('App\Contracts\Dao\Attendance\AttendanceDaoInterface', 'App\Dao\Attendance\AttendanceDao');

        // Business logic registration
        $this->app->bind('App\Contracts\Services\Attendance\AttendanceServiceInterface', 'App\Services\Attendance\AttendanceService');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('checkedin', function ($user) {
            $attendance = Employee::findOrFail($user)
                ->attendances()
                ->whereDate('created_at', Carbon::today())
                ->first();
            if ($attendance) {
                return true;
            }
            return false;
        });

        Blade::if('checkedout', function () {
            $leave = Employee::findOrFail(1)
                ->attendances()
                ->whereDate('created_at', Carbon::today())
                ->where('leave', 1)
                ->first();
            $checkout = Employee::findOrFail(1)
                ->attendances()
                ->whereDate('created_at', Carbon::today())
                ->whereNotNull('working_hours')
                ->first();
            if ($leave || $checkout) {
                return true;
            }
            return false;
        });
    }
}
