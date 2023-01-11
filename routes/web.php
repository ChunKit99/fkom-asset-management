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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/ManageUserProfile', UserProfileController::class);
Route::get('/manageUserProfile/editPassword/{id}', [UserProfileController::class, 'editPassword']);
Route::post('/manageUserProfile/updatePassword/{id}', [UserProfileController::class, 'updatePassword']);

Route::resource('/Asset', assetController::class);
Route::get('/asset/search', [assetController::class, 'search']);
Route::get('/asset/search2', [assetController::class, 'search2']);
Route::get('/asset/pdf', [assetController::class, 'createPDF']);
Route::post('/Asset/sort', [assetController::class, 'sort']);
Route::post('/Asset/filter', [assetController::class, 'filter']);
Route::get('/Asset/create', [assetController::class, 'create'])->middleware(['auth', 'isAdmin']);
Route::get('/Asset/edit', [assetController::class, 'edit'])->middleware(['auth', 'isAdmin']);

Route::resource('/MaintenanceManagement', maintenanceController::class);
Route::get('/maintenanceManagement/list', [maintenanceController::class, 'list']);
Route::get('/maintenanceManagement/add/{id}', [maintenanceController::class, 'add']);

Route::resource('/Budget', budgetController::class);


Route::resource('/VendorManagement', vendorController::class);
Route::resource('/LocationManagement', locationController::class);
