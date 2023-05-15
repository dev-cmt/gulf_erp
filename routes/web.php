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
Route::middleware([ 'auth:sanctum','verified', config('jetstream.auth_session')])->group(function () {
    Route::get('/dashboard', [BackViewController::class, 'dashboard'])->name('dashboard')->middleware('auth');
    Route::get('/coming_soon', [BackViewController::class, 'coming_soon'])->name('coming_soon')->middleware('auth');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
});


Route::group(['middleware' => ['auth']], function(){
    //------ Employee Information
    // Route::resource('info_personal', InfoPersonalController::class);
    // Route::resource('info_related', InfoRelatedController::class);
    // Route::resource('info_employee', InfoEmployeeController::class);
    Route::get('info_employee/index', [InfoEmployeeController::class, 'index'])->name('info_employee.index');
    Route::get('employee/info_prsonal/create/{id}', [InfoEmployeeController::class, 'personal_create'])->name('info_employee_prsonal.create');
    Route::post('employee/info_prsonal/store/{id}', [InfoEmployeeController::class, 'personal_store'])->name('info_employee_prsonal.store');
    
    Route::get('employee/info_related/create/{id}', [InfoEmployeeController::class, 'related_create'])->name('info_employee_related.create');
    Route::post('employee/info_related/store/{id}', [InfoEmployeeController::class, 'related_store'])->name('info_employee_related.store');
    
    Route::delete('info_related/education/destroy/{id}', [InfoEmployeeController::class, 'info_education_destroy'])->name('info_education.destroy');
    Route::delete('info_related/experience/destroy/{id}', [InfoEmployeeController::class, 'info_experience_destroy'])->name('info_experience.destroy');
    Route::delete('info_related/info_bank/destroy/{id}', [InfoEmployeeController::class, 'info_bank_destroy'])->name('info_bank.destroy');
    Route::delete('info_related/info_nominee/destroy/{id}', [InfoEmployeeController::class, 'info_nominee_destroy'])->name('info_nominee.destroy');

    //------ Leave
    Route::get('leave/self', [LeaveApplicationController::class, 'leave_application'])->name('leave_self.create');
    Route::get('get/employee_code', [LeaveApplicationController::class, 'getEmployeeCode'])->name('get_employee_code');
    Route::post('leave_application/store', [LeaveApplicationController::class, 'store'])->name('leave_application.store');
    Route::get('emergency_leave/application', [LeaveApplicationController::class, 'emergency_leave'])->name('emergency_leave.create');
    Route::post('leave_application/store', [LeaveApplicationController::class, 'store'])->name('leave_application.store');

    Route::get('dept/approve_list', [LeaveApplicationController::class, 'dept_approve_list'])->name('dept_approve_list.create');
    Route::PATCH('leave_dept/approve/{id}', [LeaveApplicationController::class, 'dept_approve'])->name('leave_dept.approve');

    Route::get('hr/approve_list', [LeaveApplicationController::class, 'hr_approve_list'])->name('hr_approve_list.create');
    Route::PATCH('leave_hr/approve/{id}', [LeaveApplicationController::class, 'hr_approve'])->name('leave_hr.approve');
    Route::PATCH('leave_application/canceled/{id}', [LeaveApplicationController::class, 'decline'])->name('leave_application.canceled');

    //------ Attendances
    Route::resource('manual_attendances', ManualAttendanceController::class);
    Route::get('attendance/approve_list', [ManualAttendanceController::class, 'attendance_approve_list'])->name('attendance_approve.create');
    Route::PATCH('attendance/approve/{id}', [ManualAttendanceController::class, 'attendance_approve'])->name('attendance.approve');
    Route::PATCH('attendance/canceled/{id}', [ManualAttendanceController::class, 'decline'])->name('attendance.canceled');
    Route::get('get/employee_repot/{id}', [ManualAttendanceController::class,'getemployee_report'])->name('get_employee_repot');
    Route::get('/attendance/import', [ManualAttendanceController::class, 'importAttendance'])->name('attendance.import');
    Route::post('/attendance/upload', [ManualAttendanceController::class, 'uploadAttendance'])->name('attendance.upload');    
    Route::get('/attendance/export', [ManualAttendanceController::class, 'exportAttendance'])->name('attendance.export'); 
});

Route::group(['middleware' => ['auth']], function(){
    //------ Master Data
    Route::resource('mast_department', MastDepartmentController::class);
    Route::resource('mast_designation', MastDesignationController::class);
    Route::resource('mast_leave', MastLeaveController::class);
    Route::resource('must_employee_category', MastEmployeeCategoryController::class);
});





//__________________________TEST EXCEL UPLOAD____________________________//
// Route::get('/attendance/import', [ManualAttendanceController::class, 'importAttendance'])->name('import_attendance.create');
// Route::post('/attendance/upload', [ManualAttendanceController::class, 'uploadAttendance'])->name('import_attendance.upload');

//__________________________ TEST AJAX MODEL_____________________________//
use App\Http\Controllers\TodoController;

Route::get('/todos', [TodoController::class, 'index']);
Route::get('todos/{todo}/edit', [TodoController::class, 'edit']);
Route::post('todos/store', [TodoController::class, 'store']);
Route::delete('todos/destroy/{todo}', [TodoController::class, 'destroy']);