<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return redirect('/login'); // Redirect to login
});

Route::get('/', function () {


    return redirect('/dashboard');
    // return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard route: Use the DashboardController
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route::get('/users', [UserController::class, 'index'])->name('users.index');
    // Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    // Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/tenants', [TenantController::class, 'index'])->name('tenants.index');
    Route::get('/tenants/create', [TenantController::class, 'create'])->name('tenants.create');
    Route::post('/tenants', [TenantController::class, 'store'])->name('tenants.store');
    Route::get('/tenants/{tenant}', [TenantController::class, 'show'])->name('tenants.show');
    Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
    Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
    Route::get('/units/create', [UnitController::class, 'create'])->name('units.create');
    Route::post('/units', [UnitController::class, 'store'])->name('units.store');
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/units', [UnitController::class, 'index'])->name('units.index');
    Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
    // Route::get('/units-by-property', [TenantController::class, 'getUnitsByProperty'])->name('units.by.property');
    Route::get('/properties/{property}/units', [PropertyController::class, 'getUnits'])->name('properties.units');
    Route::resource('tenants', TenantController::class);
    // Route::put('/tenants/{tenant}', [TenantController::class, 'edit'])->name('tenants.edit');
    // Route::put('/tenants/{id}/edit', [TenantController::class, 'edit']);
    // routes/web.php
Route::put('/tenants/{id}/edit', [TenantController::class, 'update'])->name('tenants.update');
Route::get('/tenants/{id}/edit', [TenantController::class, 'edit'])->name('tenants.edit');

// Route::get('/tenants/{id}/edit', [TenantController::class, 'edit'])->name('tenants.edit');

Route::resource('invoices', InvoiceController::class);
// Route::get('invoices/{id}/edit', [InvoiceController::class, 'edit'])->name('invoices.edit');
Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');


// Display balances
Route::get('/balances', [BalanceController::class, 'index'])->name('balances.index');

// Calculate and update balances (this could be a scheduled task or called after invoicing)
Route::get('/balances/calculate', [BalanceController::class, 'calculateBalances'])->name('balances.calculate');
Route::get('/balances', [BalanceController::class, 'index'])->name('balances.index');
Route::resource('receipts', ReceiptController::class);
Route::resource('receipts', ReceiptController::class);
Route::resource('units', UnitController::class);
Route::resource('properties', PropertyController::class);


Route::get('/bills/create', [BillController::class, 'create'])->name('bills.create');
Route::post('/bills', [BillController::class, 'store'])->name('bills.store');
Route::get('/invoices/{id}', [InvoicesController::class, 'show'])->name('invoices.show');


Route::get('invoices/{tenant_id}/add-bill', [InvoiceController::class, 'addBill'])->name('invoices.addBill');
Route::post('invoices/{tenant_id}/store-bill', [InvoiceController::class, 'storeBill'])->name('invoices.storeBill');
Route::post('/invoices/{tenant_id}/add-bill', [InvoiceController::class, 'storeBill'])->name('invoices.storeBill');

Route::get('invoices/{tenant_id}/add-bill', [InvoiceController::class, 'addBill'])->name('invoices.addBill');
Route::get('/dashboard', [UnitController::class, 'dashboard'])->name('dashboard');

// Route for AJAX request to fetch occupancy data (if needed)
Route::get('/occupancy-data', [UnitController::class, 'getOccupancyData']);
Route::get('/properties/{propertyId}/vacant-units', [TenantController::class, 'getVacantUnits']);

});

require __DIR__.'/auth.php';
