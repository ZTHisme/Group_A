<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\EmployeeController;

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
Route::group(['prefix' => 'employees'], function () {
    Route::get('/lists', [EmployeeController::class, 'index'])->name('employee#showLists');
});

Route::get('/dashboard', [EmployeeController::class, 'graph'])->name('graph#dashBoard');
