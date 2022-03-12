<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'index']);
Route::get('/admin/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'index']);

Route::get('/admin/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showAdminLoginForm']);
Route::get('/admin/logout', [App\Http\Controllers\Admin\AdminController::class, 'adminLogout']);

 // Route::view('/admin', 'admin.admin');
Route::get('/admin/profile', [App\Http\Controllers\Admin\AdminController::class, 'profile']);
Route::post('admin/validate/profile', [App\Http\Controllers\Admin\AdminController::class, 'validateUser']);
Route::post('admin/profile/update', [App\Http\Controllers\Admin\AdminController::class, 'saveProfile']);
Route::post('admin/password/validate', [App\Http\Controllers\Admin\AdminController::class, 'validatePassword']);
Route::post('admin/change/password', [App\Http\Controllers\Admin\AdminController::class, 'savePassword']);

Route::post('/forgot/password', [App\Http\Controllers\Admin\Auth\LoginController::class, 'forgotPassword']);
Route::post('/update/password', [App\Http\Controllers\Admin\Auth\LoginController::class, 'updatePassword']);
Route::get('/reset/password/{token}', [App\Http\Controllers\Admin\Auth\LoginController::class, 'resetPassword']);


Route::post('/admin/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'adminLogin']);

Route::get('/admin/user-roles', [App\Http\Controllers\Admin\AdminController::class, 'userRole']);

Route::get('/admin/modules', [App\Http\Controllers\Admin\AdminController::class, 'modules']);

Route::view('/admin/seller', 'admin.seller.seller_registration');

//Modules
Route::get('/admin/modules', [App\Http\Controllers\Admin\ModulesController::class, 'modules'])->name('admin.modules');
Route::post('/admin/modules/save', [App\Http\Controllers\Admin\ModulesController::class, 'moduleSave']);
Route::post('/admin/modules/delete', [App\Http\Controllers\Admin\ModulesController::class, 'moduleDelete']);
Route::post('/admin/modules/status', [App\Http\Controllers\Admin\ModulesController::class, 'moduleStatus']);

//Roles
Route::get('/admin/user-roles', [App\Http\Controllers\Admin\UserRoleController::class, 'userRole'])->name('admin.user-roles');
Route::get('/admin/user-roles/create', [App\Http\Controllers\Admin\UserRoleController::class, 'createRole'])->name('userRole.create');
Route::get('/admin/user-roles/edit/{role}', [App\Http\Controllers\Admin\UserRoleController::class, 'editRole'])->name('userRole.edit');
Route::get('/admin/user-roles/view/{role}', [App\Http\Controllers\Admin\UserRoleController::class, 'viewRole'])->name('userRole.view');
Route::post('/admin/user-roles/save', [App\Http\Controllers\Admin\UserRoleController::class, 'roleSave']);
Route::post('/admin/user-roles/delete', [App\Http\Controllers\Admin\UserRoleController::class, 'roleDelete']);
Route::post('/admin/user-roles/status', [App\Http\Controllers\Admin\UserRoleController::class, 'roleStatus']);

//Category
Route::get('/admin/category', [App\Http\Controllers\Admin\CategoryController::class, 'category'])->name('admin.category');
Route::get('/admin/category-new', [App\Http\Controllers\Admin\CategoryController::class, 'insert_category'])->name('admin.newcategory');
Route::post('/admin/insert-category', [App\Http\Controllers\Admin\CategoryController::class, 'create_category']);
Route::get('/admin/category/edit/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit_category']);
Route::post('/admin/update-category/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'update_category'])->name('category.update');
Route::post('/admin/delete-category/', [App\Http\Controllers\Admin\CategoryController::class, 'delete_category']);
Route::post('/admin/category/change-status/', [App\Http\Controllers\Admin\CategoryController::class, 'change_status']);
Route::post('/admin/category/sort-order', [App\Http\Controllers\Admin\CategoryController::class, 'sort_order'])->name('category.sort-order');
Route::get('/admin/category/view/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'view_category']);

//Subcategory
Route::get('/admin/subcategory-new/', [App\Http\Controllers\Admin\CategoryController::class, 'new_subcategory'])->name('subcategory.new');
Route::get('/admin/subcategory/list/{cid}/{sid}', [App\Http\Controllers\Admin\CategoryController::class, 'subcatedata']);
Route::post('/admin/insert-subcategory', [App\Http\Controllers\Admin\CategoryController::class, 'create_subcategory']);
Route::get('/admin/subcategory', [App\Http\Controllers\Admin\CategoryController::class, 'subcategory'])->name('admin.subcategory');
Route::post('/admin/delete-subcategory/', [App\Http\Controllers\Admin\CategoryController::class, 'delete_subcategory']);
Route::post('/admin/category/change-status-subcategory/', [App\Http\Controllers\Admin\CategoryController::class, 'change_status_subcategory']);
Route::post('/admin/update-subcategory/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'update_subcategory'])->name('subcategory.update');
Route::get('/admin/subcategory/edit/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit_subcategory']);
Route::get('/admin/subcategory/view/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'view_subcategory']);
Route::post('/admin/subcategory/sort-order', [App\Http\Controllers\Admin\CategoryController::class, 'subcat_sort_order'])->name('subcategory.sort-order');
Route::post('/admin/subcategory-ajax/', [App\Http\Controllers\Admin\ProductController::class, 'subCat'])->name('subcategory_ajax');

Route::get('/admin/settings', [App\Http\Controllers\Admin\SettingsOthersController::class, 'settings'])->name('admin.settings');
Route::post('/admin/settings/save', [App\Http\Controllers\Admin\SettingsOthersController::class, 'settingsSave']);

Route::post('/admin/editor-image', [App\Http\Controllers\Admin\SellerProductController::class, 'editorImage']);


Route::post('/admin/modules/sort-order', [App\Http\Controllers\Admin\ModulesController::class, 'sort_order'])->name('modules.sort-order');

//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});