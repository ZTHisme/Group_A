<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\EmployeeController;
//use App\Http\Controllers\Employee\ImageUploadController;

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
//Route::group(['prefix' => 'employees'], function () {
//    
//    Route::get('/lists', [EmployeeController::class, 'index'])->name('employee#showLists');
//
//    Route::get('/employees/add', [EmployeeController::class, 'showEmployeeForm'])->name('addEmployee.get');
//
//    Route::post('/employees/add', [EmployeeController::class, 'submitEmployeeForm'])->name('addEmployee.post');
//});

Route::get('/', function () {
    return view('Employee.index');
});
Route::get('/', [EmployeeController::class, 'showEmployeeList'])->name('employeeList');
Route::get('/lists', [EmployeeController::class, 'index'])->name('employee#showLists');

Route::get('/employee/show/{id}', [EmployeeController::class, 'showEmployeeDetailForm'])->name('show.employee.get');

Route::get('/employees/add', [EmployeeController::class, 'showEmploeeForm'])->name('addEmployee.get');
Route::post('/employees/add', [EmployeeController::class, 'submitEmployeeForm'])->name('addEmployee.post');

Route::get('/employee/edit/{id}', [EmployeeController::class, 'showEmployeeEditForm'])->name('edit.employee.get');
Route::post('/employee/edit/{id}', [EmployeeController::class, 'submitEmployeeEditForm'])->name('edit.employee.post');

Route::get('/student/delete/{id}', [EmployeeController::class, 'deleteEmployee'])->name('delete.employee');




//Route::get('/employees/add', [EmployeeController::class, 'showEmploeeForm'])->name('addEmployee.get');
//Route::post('/employees/add', [EmployeeController::class, 'submitEmployeeForm'])->name('addEmployee.post');
//Route::get('image/upload', [EmployeeController::class, 'imageUpload'])->name('image.upload');
//Route::post('image/upload', [EmployeeController::class, 'imageUploadPost'])->name('image.upload.post');
//Route::resource('image', EmployeeController::class);
//Route::get('/', [EmployeeController::class, 'showEmployeeList'])->name('employeeList');
