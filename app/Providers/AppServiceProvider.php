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
        $this->app->bind('App\Contracts\Dao\Employee\EmployeeDaoInterface', 'App\Dao\Employee\EmployeeDao');
        $this->app->bind('App\Contracts\Dao\Attendance\AttendanceDaoInterface', 'App\Dao\Attendance\AttendanceDao');
        $this->app->bind('App\Contracts\Dao\Auth\AuthDaoInterface', 'App\Dao\Auth\AuthDao');
        $this->app->bind('App\Contracts\Dao\Payroll\PayrollDaoInterface', 'App\Dao\Payroll\PayrollDao');

        // Business logic registration
        $this->app->bind('App\Contracts\Services\Employee\EmployeeServiceInterface', 'App\Services\Employee\EmployeeService');
        $this->app->bind('App\Contracts\Services\Attendance\AttendanceServiceInterface', 'App\Services\Attendance\AttendanceService');
        $this->app->bind('App\Contracts\Services\Auth\AuthServiceInterface', 'App\Services\Auth\AuthService');
        $this->app->bind('App\Contracts\Services\Auth\ForgetPasswordInterface', 'App\Services\Auth\ForgetPasswordService');
        $this->app->bind('App\Contracts\Services\Payroll\PayrollServiceInterface', 'App\Services\Payroll\PayrollService');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {        
        Blade::if('checkedin', function () {
            if (auth()->check()) {
                $attendance = auth()->user()
                    ->attendances()
                    ->whereDate('created_at', Carbon::today())
                    ->first();
                if ($attendance) {
                    return true;
                }
                return false;
            }
        });

        Blade::if('checkedout', function () {
            if (auth()->check()) {
                $leave = auth()->user()
                    ->attendances()
                    ->whereDate('created_at', Carbon::today())
                    ->where('leave', 1)
                    ->first();
                $checkout = auth()->user()
                    ->attendances()
                    ->whereDate('created_at', Carbon::today())
                    ->whereNotNull('working_hours')
                    ->first();
                if ($leave || $checkout) {
                    return true;
                }
                return false;
            }
        });
    }
}
