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

    // Route::resource('/AdminMaintenanceManagement', adminMaintenanceController::class);

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/ManageUserProfile', UserProfileController::class);
Route::get('/manageUserProfile/editPassword/{id}', [UserProfileController::class, 'editPassword']);
Route::post('/manageUserProfile/updatePassword/{id}', [UserProfileController::class, 'updatePassword']);

Route::middleware(['auth'])->group(function () {
    Route::resource('/Asset', assetController::class);
    Route::get('/asset/search', [assetController::class, 'search']);
    Route::get('/asset/search2', [assetController::class, 'search2']);
    Route::get('/asset/pdf', [assetController::class, 'createPDF']);
    Route::post('/Asset/sort', [assetController::class, 'sort']);
    Route::post('/Asset/filter', [assetController::class, 'filter']);
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/Asset/create', [assetController::class, 'create']);
    Route::get('/Asset/{id}/edit', [assetController::class, 'edit'])->middleware(['auth', 'isAdmin']);
    Route::delete('/Asset/{id}', [assetController::class, 'destroy'])->middleware(['auth', 'isAdmin']);
});

Route::resource('/MaintenanceManagement', maintenanceController::class);
Route::get('/maintenanceManagement/list', [maintenanceController::class, 'list']);
Route::resource('/AdminMaintenanceManagement', adminMaintenanceController::class);

//Route::resource('/Budget', budgetController::class);

Route::middleware(['auth'])->group(function () {
    Route::resource('/Budget', budgetController::class);

});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/BudgetManagement/listBudget', [budgetController::class, 'list']);
    Route::get('/BudgetManagement/reportMaintenance', [budgetController::class, 'maintenanceView']);
    Route::get('/budget/exportcsv1', [budgetController::class, 'exportCSV1'])->name('budget.exportcsv1');
    Route::get('/budget/exportcsv2', [budgetController::class, 'exportCSV2'])->name('budget.exportcsv2');
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
    Route::get('/VendorManagement/create', [locationController::class, 'create']);
    Route::get('/VendorManagement/{id}/edit', [locationController::class, 'edit']);
});
