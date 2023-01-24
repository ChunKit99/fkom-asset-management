<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\UserAccController;
use App\Http\Controllers\Admin\UserDetailController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\vendorController;
use App\Http\Controllers\locationController;
use App\Http\Controllers\maintenanceController;
use App\Http\Controllers\adminMaintenanceController;
use App\Http\Controllers\assetController;
use App\Http\Controllers\budgetController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/',[App\Http\Controllers\Frontend\FrontendController::class,'index']);

Route::prefix('Admin')->middleware(['auth', 'isAdmin'])->group(function(){

    Route::get('/Main', [App\Http\Controllers\Admin\MainController::class, 'index']);
    Route::resource('/ManageUserAccount', UserAccController::class);
    Route::resource('/ManageUserDetail', UserDetailController::class);
    Route::resource('/ManageAdminProfile', AdminProfileController::class);
    Route::get('/manageAdminProfile/editPassword/{id}', [AdminProfileController::class, 'editPassword']);
    Route::post('/manageAdminProfile/updatePassword/{id}', [AdminProfileController::class, 'updatePassword']);

});

Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/ManageUserProfile', UserProfileController::class);
Route::get('/manageUserProfile/editPassword/{id}', [UserProfileController::class, 'editPassword']);
Route::post('/manageUserProfile/updatePassword/{id}', [UserProfileController::class, 'updatePassword']);

Route::middleware(['auth'])->group(function () {
    Route::resource('/Asset', assetController::class);
    Route::get('/asset/search', [assetController::class, 'search']);
    Route::get('/asset/search2', [assetController::class, 'search2']);
    Route::get('/asset/pdf', [assetController::class, 'createPDF']);
    Route::get('/asset/pdfhome', [assetController::class, 'userHomeCreatePDF']);
    Route::post('/Asset/sort', [assetController::class, 'sort']);
    Route::post('/Asset/filter', [assetController::class, 'filter']);
});

Route::middleware(['isAdmin', 'auth'])->group(function () {
    Route::get('/Asset/create', [assetController::class, 'create']);
    Route::get('/Asset/edit/{id}', [assetController::class, 'edit']);
    Route::delete('/Asset/{id}', [assetController::class, 'destroy']);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('/MaintenanceManagement', maintenanceController::class);
    Route::get('/maintenanceManagement/list', [maintenanceController::class, 'list']);
    Route::get('/maintenanceManagement/search', [maintenanceController::class, 'search']);
    Route::post('/MaintenanceManagement/sort', [maintenanceController::class, 'sort']);
    Route::post('/MaintenanceManagement/filter', [maintenanceController::class, 'filter']);
    // Route::get('/maintenanceManagement/pdf', [maintenanceController::class, 'createPDF']);
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/maintenanceManagement/status', [maintenanceController::class, 'status'])->middleware(['auth', 'isAdmin']);
    Route::post('/maintenanceManagement/submitStatus', [maintenanceController::class, 'submitStatus'])->middleware(['auth', 'isAdmin']);
    Route::get('/maintenanceManagement/cost', [maintenanceController::class, 'cost'])->middleware(['auth', 'isAdmin']);
    Route::post('/maintenanceManagement/submitCost', [maintenanceController::class, 'submitCost'])->middleware(['auth', 'isAdmin']);
});
// Route::resource('/AdminMaintenanceManagement', adminMaintenanceController::class);

//Route::resource('/Budget', budgetController::class);

Route::middleware(['auth'])->group(function () {
    Route::resource('/Budget', budgetController::class);

});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/BudgetManagement/listBudget', [budgetController::class, 'list']);
    Route::get('/Budget/{id}/edit', [budgetController::class, 'edit'])->middleware(['auth', 'isAdmin']);
});



Route::middleware(['auth'])->group(function () {

Route::resource('/VendorManagement', vendorController::class);
Route::resource('/LocationManagement', locationController::class);
//csv_file
Route::get('location/exportcsv', [locationController::class, 'exportCSV'])->name('location.exportcsv');
Route::get('vendor/exportcsv', [vendorController::class, 'exportCSV'])->name('vendor.exportcsv');
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/LocationManagement/create', [locationController::class, 'create']);
    Route::get('/LocationManagement/{id}/edit', [locationController::class, 'edit']);
    Route::get('/VendorManagement/create', [vendorController::class, 'create']);
    Route::get('/VendorManagement/{id}/edit', [vendorController::class, 'edit']);
});
