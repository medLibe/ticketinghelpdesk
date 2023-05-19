<?php

use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HelpdeskController;
use App\Http\Controllers\HomeSettingController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserRoleController;
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

// Route::get('/', function () {
//     return view('admin.dashboard');
// });

Route::get('/', [AuthenticateController::class, 'index'])->name('login');

// Authenticate
Route::controller(AuthenticateController::class)->group(function() {
    Route::post('/auth', 'auth')->name('auth');
    Route::get('/logout', 'logout')->name('logout');
});

Route::controller(HomeSettingController::class)->group(function() {
    Route::get('/admin/dashboard', 'index')->name('admin.dashboard')->middleware('auth');
});

Route::controller(UserRoleController::class)->group(function() {
    // User
    Route::get('/admin/user', 'index')->name('admin.user')->middleware('auth');

    // Role
    Route::get('/admin/role', 'role')->name('admin.role')->middleware('auth');
    Route::get('/admin/role-ajax', 'getRole')->name('admin.role-ajax')->middleware('auth');
    Route::post('/admin/role-store', 'roleStore')->name('admin.role-store')->middleware('auth');
    Route::post('/admin/role-update', 'roleUpdate')->name('admin.role-update')->middleware('auth');
    Route::post('/admin/role-delete', 'roleDelete')->name('admin.role-delete')->middleware('auth');
});


Route::controller(DepartmentController::class)->group(function() {
    // Department
    Route::get('/admin/department', 'index')->name('admin.department')->middleware('auth');
    Route::get('/admin/department-ajax', 'getDepartment')->name('admin.department-ajax')->middleware('auth');
    Route::post('/admin/department-store', 'departmentStore')->name('admin.department-store')->middleware('auth');
    Route::post('/admin/department-update', 'departmentUpdate')->name('admin.department-update')->middleware('auth');
    Route::post('/admin/department-delete', 'departmentDelete')->name('admin.department-delete')->middleware('auth');
});

Route::controller(HelpdeskController::class)->group(function() {
    // Helpdesk
    Route::get('/admin/helpdesk', 'index')->name('admin.helpdesk')->middleware('auth');
    Route::get('/admin/helpdesk-ajax', 'getHelpdesk')->name('admin.helpdesk-ajax')->middleware('auth');
    Route::post('/admin/helpdesk-store', 'helpdeskStore')->name('admin.helpdesk-store')->middleware('auth');
    Route::post('/admin/helpdesk-update', 'helpdeskUpdate')->name('admin.helpdesk-update')->middleware('auth');
    Route::post('/admin/helpdesk-delete', 'helpdeskDelete')->name('admin.helpdesk-delete')->middleware('auth');
});

Route::controller(TicketController::class)->group(function() {
    // Ticket - Other department beside IT
    Route::get('/helpdeskticket', 'createTicket')->name('helpdeskticket');
    Route::post('/helpdeskticket-submit', 'submitTicket')->name('helpdeskticket-submit');
    Route::get('/helpdeskticket-check', 'checkTicket')->name('helpdeskticket-check');
    Route::get('/helpdeskticket-submitted/{id}', 'submittedTicket')->name('helpdeskticket-submitted');


    // Ticket - Admin
    Route::get('/admin/ticket', 'index')->name('admin.ticket')->middleware('auth');
    Route::get('/admin/ticket-report', 'reportTicket')->name('admin.ticket-report')->middleware('auth');
    Route::get('/admin/ticket-ajax', 'getTicket')->name('admin.ticket-ajax')->middleware('auth');
    Route::get('/admin/ticket-report-ajax/{id}', 'getReportTicket')->name('admin.ticket-report-ajax')->middleware('auth');
    Route::get('/admin/ticket-view/{id}', 'viewTicket')->name('admin.ticket-view')->middleware('auth');
    Route::post('/admin/ticket-approval/{id}', 'approvalTicket')->name('admin.ticket-approval')->middleware('auth');
});
