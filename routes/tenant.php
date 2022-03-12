<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

// Route::middleware([
//     'web',
//     InitializeTenancyByDomain::class,
//     PreventAccessFromCentralDomains::class,
// ])->group(function () {
//     Route::get('/', function () {
//         return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
//     });
// });


Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/admins-list', [App\Http\Controllers\Admin\AdminController::class, 'admins'])->name('admin.admins');
Route::get('/admins-list/create', [App\Http\Controllers\Admin\AdminController::class, 'createAdmin'])->name('admins.create');
Route::get('/admins-list/edit/{role}', [App\Http\Controllers\Admin\AdminController::class, 'editAdmin'])->name('admins.edit');
Route::get('/admins-list/view/{admin}', [App\Http\Controllers\Admin\AdminController::class, 'viewAdmin'])->name('admins.view');
Route::post('/admins-list/save', [App\Http\Controllers\Admin\AdminController::class, 'adminSave']);
Route::post('/admins-list/status', [App\Http\Controllers\Admin\AdminController::class, 'adminStatus']);
Route::post('/admins-list/delete', [App\Http\Controllers\Admin\AdminController::class, 'adminDelete']);
});

