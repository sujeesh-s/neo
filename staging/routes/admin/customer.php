<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin/customer', [App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('admin.customer');
Route::post('/admin/customer/register', [App\Http\Controllers\Admin\CustomerController::class, 'register'])->name('customeregister');
Route::get('/admin/customer/view/{id}', [App\Http\Controllers\Admin\CustomerController::class, 'view_customer']);
Route::post('/admin/customer/update-profile/{id}', [App\Http\Controllers\Admin\CustomerController::class, 'update_profile']);



