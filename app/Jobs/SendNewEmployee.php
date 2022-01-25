<?php

namespace App\Jobs;

use App\Mail\EmployeeMail;
use App\Models\Employee;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendNewEmployee implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The employee instance.
     *
     * @var \App\Models\Employee
     */
    public $employee;

    /**
     * Create a new employee instance.
     *
     * @return void
     */
    public function __construct(Employee $employees)
    {
        $this->employee = $employees;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = DB::table('employees')
            ->join('mst_roles', 'employees.role_id', '=', 'mst_roles.id')
            ->where('mst_roles.name', 'Manager')
            ->select('employees.*')
            ->get();

        //dd($email);

        Mail::to($email)
            ->send(new EmployeeMail($this->employee));
    }
}
