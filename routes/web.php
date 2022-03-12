<?php

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


Auth::routes();

// Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'index']);

Route::get('/home', [App\Http\Controllers\Admin\AdminController::class, 'index']);
 
// Route::get('/', [App\Http\Controllers\Web\RegisterController::class, 'index']);

foreach (glob(__DIR__ . '/admin/*.php') as $filename) { require_once($filename); }
foreach (glob(__DIR__ . '/seller/*.php') as $filename) { require_once($filename); }

// Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'index']);

    Route::get('superadmin/admins-list', [App\Http\Controllers\Admin\AdminController::class, 'superadmins'])->name('admin.admins');
Route::get('/admins-list/create', [App\Http\Controllers\Admin\AdminController::class, 'createAdmin'])->name('admins.create');
Route::get('/admins-list/edit/{role}', [App\Http\Controllers\Admin\AdminController::class, 'editAdmin'])->name('admins.edit');
Route::get('/admins-list/view/{admin}', [App\Http\Controllers\Admin\AdminController::class, 'viewAdmin'])->name('admins.view');
Route::post('/admins-list/save', [App\Http\Controllers\Admin\AdminController::class, 'adminSave']);
Route::post('/admins-list/status', [App\Http\Controllers\Admin\AdminController::class, 'adminStatus']);
Route::post('/admins-list/delete', [App\Http\Controllers\Admin\AdminController::class, 'adminDelete']);