<?php

use Illuminate\Support\Facades\Route;


Route::get('/register', [App\Http\Controllers\Web\RegisterController::class, 'register']);
Route::post('/register', [App\Http\Controllers\Web\RegisterController::class, 'saveOrg']);
Route::post('/register/validate', [App\Http\Controllers\Web\RegisterController::class, 'validateOrg']);

Route::get('/welcome/{tenant}', [App\Http\Controllers\Web\RegisterController::class, 'welcomeUser'])->name('org.welcome');
Route::post('/welcomeform/validate', [App\Http\Controllers\Web\RegisterController::class, 'validateWelcomeform']);
Route::post('/welcomeform', [App\Http\Controllers\Web\RegisterController::class, 'saveWelcomeform']);
