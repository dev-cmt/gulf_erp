<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LocationController;

use App\Http\Controllers\Admin\BackViewController;
use App\Http\Controllers\Admin\InfoPersonalController;
use App\Http\Controllers\Admin\InfoRelatedController;
use App\Http\Controllers\Admin\InfoEmployeeController;
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


//==================// Location //==================//
Route::get('/location', [LocationController::class, 'index'])->name('location');
Route::get('/get-districts', [LocationController::class, 'getDistricts'])->name('get_districts');
Route::get('/get-upazila', [LocationController::class, 'getUpazilas'])->name('get_upazila');
Route::get('/get-thana', [LocationController::class, 'getThanas'])->name('get_thana');


//____________________// START \\_________________//
Route::middleware([ 'auth:sanctum','verified','member', config('jetstream.auth_session')])->group(function () {
    Route::get('/dashboard', [BackViewController::class, 'dashboard'])->name('dashboard')->middleware('auth');
    Route::get('/coming_soon', [BackViewController::class, 'coming_soon'])->name('coming_soon')->middleware('auth');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
});


Route::group(['middleware' => ['auth']], function(){
    //------ Employee Information
    Route::resource('info_personal', InfoPersonalController::class);
    // Route::resource('info_related', InfoRelatedController::class);

    Route::resource('info_employee', InfoEmployeeController::class);
    Route::get('employee/info_prsonal/create/{id}', [InfoEmployeeController::class, 'personal_create'])->name('info_employee_prsonal.create');
    Route::post('employee/info_prsonal/store/{id}', [InfoEmployeeController::class, 'personal_store'])->name('info_employee_prsonal.store');
    Route::get('employee/info_related/create/{id}', [InfoEmployeeController::class, 'related_create'])->name('info_employee_related.create');
    Route::post('employee/info_related/store/{id}', [InfoEmployeeController::class, 'related_store'])->name('info_employee_related.store');
    Route::delete('info_related/education/destroy/{id}', [InfoEmployeeController::class, 'related_education_destroy'])->name('info_employee_education.destroy');
    Route::delete('info_related/experience/destroy/{id}', [InfoEmployeeController::class, 'experience_education_destroy'])->name('info_employee_experience.destroy');
    Route::delete('info_related/info_bank/destroy/{id}', [InfoEmployeeController::class, 'experience_info_bank_destroy'])->name('info_employee_info_bank.destroy');

    //------ Leave
    Route::get('/leave_self', [LeaveApplicationController::class, 'leave_application'])->name('leave_self.create');
    Route::get('/get_employee_code', [LeaveApplicationController::class, 'getEmployeeCode'])->name('get_employee_code');
    Route::post('leave_application/store', [LeaveApplicationController::class, 'store'])->name('leave_application.store');
    Route::get('/emergency_leave_application', [LeaveApplicationController::class, 'emergency_leave_application'])->name('emergency_leave.create');
    Route::post('leave_application/store', [LeaveApplicationController::class, 'store'])->name('leave_application.store');
    //------ Leave
    // Route::get('/self_leave', [LeaveApplicationController::class, 'self_leave'])->name('self_leave');
    // Route::get('/leave_process', [LeaveApplicationController::class, 'application'])->name('leave_process');
    // Route::get('/dept_approve', [LeaveApplicationController::class, 'dept_approve'])->name('dept_approve');
    // Route::get('/hr_approve', [LeaveApplicationController::class, 'hr_approve'])->name('hr_approve');
    // Route::get('/emergency_leave', [LeaveApplicationController::class, 'emergency_leave'])->name('emergency_leave');
    // Route::post('/leave/store', [LeaveApplicationController::class, 'store'])->name('leave.store');
    // Route::PATCH('/leave/approve/{id}', [LeaveApplicationController::class, 'approve'])->name('leave.approve');
    // Route::PATCH('/leave/decline/{id}', [LeaveApplicationController::class, 'decline'])->name('leave.decline');
    //------ Attendances
    Route::resource('manualattendances',ManualAttendanceController::class);
    Route::get('/attendance_approve', [ManualAttendanceController::class, 'attendance_approve'])->name('attendance_approve');
    Route::get('/get-employee-code',[ManualAttendanceController::class,'employeeCode'])->name('get-employee-code');

    Route::PATCH('/attendance-approval/{id}', [ManualAttendanceController::class, 'approve'])->name('attendance_approval');
    Route::PATCH('/attendance-decline/{id}', [ManualAttendanceController::class, 'decline'])->name('attendance_decline');
    Route::get('get-employee-repot/{id}',[ManualAttendanceController::class,'getemployeereport'])->name('get-employee-report');

});

Route::group(['middleware' => ['auth']], function(){
    //------ Master Data
    Route::resource('mast_department', MastDepartmentController::class);
    Route::resource('mast_designation', MastDesignationController::class);
    Route::resource('mast_leave', MastLeaveController::class);
    Route::resource('must_employee_category', MastEmployeeCategoryController::class);
});





//__________________________ TEST _____________________________//
use App\Http\Controllers\TodoController;

Route::get('/todos', [TodoController::class, 'index']);
Route::get('todos/{todo}/edit', [TodoController::class, 'edit']);
Route::post('todos/store', [TodoController::class, 'store']);
Route::delete('todos/destroy/{todo}', [TodoController::class, 'destroy']);