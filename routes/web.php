<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Attendance\AttendanceController;
use App\Http\Controllers\Payroll\PayrollController;

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
Route::middleware('auth')->group(['prefix' => 'employees'], function () {
    Route::get('/lists', [EmployeeController::class, 'index'])->name('employee#showLists');
});

Route::get('/', function () {
    return redirect()->route('attendances#index');
});

// Attendance Routes
Route::prefix('attendances')->middleware('auth')->group(function() {
    Route::get('list', [AttendanceController::class, 'index'])->name('attendances#index');
    Route::post('store', [AttendanceController::class, 'store'])->name('attendances#store');
    Route::get('update', [AttendanceController::class, 'update'])->name('attendances#update');
});

// Payroll Routes
Route::prefix('payrolls')->middleware('auth')->group(function() {
    Route::get('list', [PayrollController::class, 'index'])->name('payrolls#index');
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
