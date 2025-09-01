<?php

use App\Models\Customer;
use App\Livewire\Master\CustomerForm;
use Illuminate\Support\Facades\Route;
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
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';
