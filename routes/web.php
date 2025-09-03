<?php

use Illuminate\Support\Facades\Route;
use App\Models\{Customer, Site, Labor, Attendance};
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::middleware(['auth', 'verified'])->group(function () {
    //Dashboard
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    //Masters - Customer
    Route::view('/master/customer', 'master.customer.create')->name('customer.create');
    Route::get('/master/{customer}/customer', fn(Customer $customer) => view('master.customer.edit', ['customer' => $customer]))->name('customer.edit');
    Route::view('/master/customers',  'master.customer.index')->name('customer.index');

    //Masters - Site
    Route::view('/master/site', 'master.site.create')->name('site.create');
    Route::get('/master/{site}/site', fn(Site $site) => view('master.site.edit', ['site' => $site]))->name('site.edit');
    Route::view('/master/sites',  'master.site.index')->name('site.index');

    //Masters - Labor
    Route::view('/master/labor', 'master.labor.create')->name('labor.create');
    Route::get('/master/{labor}/labor', fn(Labor $labor) => view('master.labor.edit', ['labor' => $labor]))->name('labor.edit');
    Route::view('/master/labors',  'master.labor.index')->name('labor.index');

    //Transactions - Attendance
    Route::view('/transaction/attendance', 'transaction.attendance.create')->name('attendance.create');
    Route::get('/transaction/{attendance}/labor', fn(Attendance $attendance) => view('transaction.attendance.edit', ['attendance' => $attendance]))->name('attendance.edit');
    Route::view('/transaction/attendances',  'transaction.attendance.index')->name('attendance.index');

    //Transactions - Attendance - Employee
    Route::view('/transaction/attendance/employee', 'transaction.attendance.employee-create')->name('attendance.employee.create');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';
