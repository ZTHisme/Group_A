<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Attendance\AttendanceController;
use App\Http\Controllers\Payroll\PayrollController;
use App\Http\Controllers\Project\ProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Employee list resource route
Route::prefix('employees')->middleware('auth')->group(function () {
    Route::get('/lists', [EmployeeController::class, 'index'])->name('employee#showLists');
    Route::get('employees/download', [EmployeeController::class, 'downloadCSV'])->name('employees.download');
    Route::get('employees/upload', [EmployeeController::class, 'showUpload'])->name('employees.upload');
    Route::post('employees/submit', [EmployeeController::class, 'submitUpload'])->name('employees.submit');
    Route::get('/show/{id}', [EmployeeController::class, 'showEmployeeDetailForm'])->name('show.employee.get');
    Route::get('add', [EmployeeController::class, 'showEmploeeForm'])->name('addEmployee.get');
    Route::post('add', [EmployeeController::class, 'submitEmployeeForm'])->name('addEmployee.post');
    Route::get('/edit/{id}', [EmployeeController::class, 'showEmployeeEditForm'])->name('edit.employee.get');
    Route::patch('/edit/{id}', [EmployeeController::class, 'submitEmployeeEditForm'])->name('edit.employee.post');
    Route::delete('/delete/{id}', [EmployeeController::class, 'deleteEmployee'])->name('delete.employee');
});

// Dashboard route to show chart
Route::get('/dashboard', [EmployeeController::class, 'graph'])->name('graph#dashBoard')->middleware('auth');

Route::get('/', function () {
    return redirect()->route('graph#dashBoard');
});

// Attendance Routes
Route::prefix('attendances')->middleware('auth')->group(function () {
    Route::get('list', [AttendanceController::class, 'index'])->name('attendances#index');
    Route::post('store', [AttendanceController::class, 'store'])->name('attendances#store');
    Route::get('update', [AttendanceController::class, 'update'])->name('attendances#update');
});

// Payroll Routes
Route::prefix('payrolls')->middleware('auth')->group(function () {
    Route::get('list', [PayrollController::class, 'index'])->name('payrolls#index');
    Route::get('{employee}/calculate', [PayrollController::class, 'calculate'])->name('payrolls#calculate');
    Route::get('sendpayrollmail/{finalsalary}', [PayrollController::class, 'sendPayrollMail'])
        ->name('payrolls#sendPayrollMail');
    Route::get('{employee}/recalculate', [PayrollController::class, 'recalculate'])->name('payrolls#recalculate');
    Route::get('editview/{employee}', [PayrollController::class, 'showEditView'])
        ->name('payroll#showEditView');
    Route::patch('updatepayroll/{employee}', [PayrollController::class, 'updatePayroll'])
        ->name('payrolls#updatePayroll');
});

// Project Management Routes
Route::prefix('projects')->middleware('auth')->group(function () {
    Route::get('list', [ProjectController::class, 'index'])->name('projects#index');
    Route::get('createview', [ProjectController::class, 'showCreateView'])
        ->name('projects#showCreateView');
    Route::post('store', [ProjectController::class, 'postCreate'])
        ->name('projects#postCreate');
    Route::get('{project}/members', [ProjectController::class, 'getMembers'])
        ->name('projects#getMembers');
    Route::get('editview/{project}', [ProjectController::class, 'showEditView'])
        ->name('projects#showEditView');
    Route::get('{project}/membertoogle/{id}', [ProjectController::class, 'memberToogle'])
        ->name('projects#memberToogle');
    Route::patch('updateproject/{project}', [ProjectController::class, 'updateProject'])
        ->name('projects#updateProject');
    Route::delete('deleteproject/{project}', [ProjectController::class, 'deleteProject'])
        ->name('projects#deleteProject');
});

// Custom auth routes
Route::group(['middleware' => ['guest']], function () {
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
    Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])
        ->name('forget.password.get');
    Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])
        ->name('forget.password.post');
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])
        ->name('reset.password.get');
    Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])
        ->name('reset.password.post');
});
Route::get('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
