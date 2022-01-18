<?php

use App\Http\Controllers\Attendance\AttendanceController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('layouts.app');
});

// Attendance Routes
Route::prefix('attendances')->group(function() {
    Route::get('list', [AttendanceController::class, 'index'])->name('attendances#index');
    Route::post('store', [AttendanceController::class, 'store'])->name('attendances#store');
    Route::get('update', [AttendanceController::class, 'update'])->name('attendances#update');
});
