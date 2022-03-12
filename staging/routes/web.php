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

Route::get('/', function () {
    return view('/welcome');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'index']);

 Route::view('/home', 'home')->middleware('auth');
 


foreach (glob(__DIR__ . '/admin/*.php') as $filename) { require_once($filename); }
foreach (glob(__DIR__ . '/seller/*.php') as $filename) { require_once($filename); }


Route::post('/admin/getDropdown', [App\Http\Controllers\Admin\HomeController::class, 'dropdownData']);
