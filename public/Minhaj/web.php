<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LocationController;

use App\Http\Controllers\Admin\BackViewController;
use App\Http\Controllers\Admin\InfoPersonalController;
use App\Http\Controllers\Admin\InfoRelatedController;
use App\Http\Controllers\Admin\LeaveApplicationController;
use App\Http\Controllers\Admin\ManualAttendanceController;
use App\Http\Controllers\Admin\attendanceApproveController;

//---Master Data
use App\Http\Controllers\Master\MastDepartmentController;
use App\Http\Controllers\Master\MastDesignationController;
use App\Http\Controllers\Master\MastLeaveController;
use App\Http\Controllers\Master\MastEmployeeCategoryController;

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
    return view('auth.login');
});

Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard')->middleware('auth');
Route::get('/coming_soon', function () {return view('coming_soon');})->name('coming_soon')->middleware('auth');

//==================// Location //==================//
Route::get('/location', [LocationController::class, 'index'])->name('location');
Route::get('/get-districts', [LocationController::class, 'getDistricts'])->name('get_districts');
Route::get('/get-upazila', [LocationController::class, 'getUpazilas'])->name('get_upazila');
Route::get('/get-thana', [LocationController::class, 'getThanas'])->name('get_thana');


//____________________// START \\_________________//
Route::middleware([ 'auth:sanctum','verified','member', config('jetstream.auth_session')])->group(function () {
    Route::get('/dashboard', [BackViewController::class, 'dashboard'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
});


Route::group(['middleware' => ['auth']], function(){
    //------ Personal Info
    Route::resource('info_personal', InfoPersonalController::class);
    Route::resource('info_related', InfoRelatedController::class);

    //------ Leave
    Route::get('/self_leave', [LeaveApplicationController::class, 'self_leave'])->name('self_leave');

    Route::get('/leave_process', [LeaveApplicationController::class, 'application'])->name('leave_process');
    Route::get('/dept_approve', [LeaveApplicationController::class, 'dept_approve'])->name('dept_approve');
    Route::get('/hr_approve', [LeaveApplicationController::class, 'hr_approve'])->name('hr_approve');
    Route::get('/emergency_leave', [LeaveApplicationController::class, 'emergency_leave'])->name('emergency_leave');
    Route::post('/leave/store', [LeaveApplicationController::class, 'store'])->name('leave.store');
    Route::PATCH('/leave/approve/{id}', [LeaveApplicationController::class, 'approve'])->name('leave.approve');
    Route::PATCH('/leave/decline/{id}', [LeaveApplicationController::class, 'decline'])->name('leave.decline');


    //------ Attendances
    Route::resource('manualattendances',ManualAttendanceController::class);
    Route::get('/attendance_approve', [ManualAttendanceController::class, 'attendance_approve'])->name('attendance_approve');

});

Route::group(['middleware' => ['auth']], function(){
    //------ Master Data
    Route::resource('mast_department', MastDepartmentController::class);
    Route::resource('mast_designation', MastDesignationController::class);
    Route::resource('mast_leave', MastLeaveController::class);
    Route::resource('must_employee_category', MastEmployeeCategoryController::class);
});

