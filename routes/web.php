<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});




Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('/customers', CustomerController::class);
Route::resource('/tenants', TenantController::class);
Route::resource('/invoices', InvoiceController::class);
Route::get('/invoices/{invoice}/voucher', [VoucherController::class, 'voucher'])->name('invoices.voucher');
Route::get('/redeem', [VoucherController::class, 'create'])->name('voucher.create');
Route::post('/redeem', [VoucherController::class, 'voucherRedeem'])->name('voucher.redeem');
