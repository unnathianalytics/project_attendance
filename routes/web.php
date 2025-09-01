<?php

use App\Models\Customer;
use App\Livewire\Master\CustomerForm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
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
