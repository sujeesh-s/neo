<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin/customer', [App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('admin.customer');
Route::post('/admin/customer/register', [App\Http\Controllers\Admin\CustomerController::class, 'register'])->name('customeregister');
Route::get('/admin/customer/view/{id}', [App\Http\Controllers\Admin\CustomerController::class, 'view_customer']);
Route::post('/admin/customer/update-profile/{id}', [App\Http\Controllers\Admin\CustomerController::class, 'update_profile']);
Route::get('/admin/customer/invoice/{id}', [App\Http\Controllers\Admin\CustomerController::class, 'invoice'])->name('customer.invoice');

Route::get('/admin/customer/wallet/', [App\Http\Controllers\Admin\CustomerWallet::class, 'index'])->name('customer.wallet');
Route::get('/admin/customer/wallet-log/{id}', [App\Http\Controllers\Admin\CustomerWallet::class, 'wallet_log']);
Route::post('/admin/customer/wallet-delete/', [App\Http\Controllers\Admin\CustomerWallet::class, 'delete_wallet']);



