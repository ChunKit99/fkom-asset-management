<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\vendorController;
use App\Http\Controllers\locationController;
use App\Http\Controllers\maintenanceController;
use App\Http\Controllers\assetController;
use App\Http\Controllers\budgetController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\FacultyMemberController;

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
    return view('/auth/login');
});

// Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {

//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');

//         require 'admin.php';   
// });

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

require 'admin.php';

Route::resource('/admin', UserController::class);
Route::resource('/FacultyMember', FacultyMemberController::class);


Route::resource('/Asset', assetController::class);
Route::get('/asset/search', [assetController::class, 'search']);
Route::get('/asset/search2', [assetController::class, 'search2']);
Route::get('/asset/pdf', [assetController::class, 'createPDF']);
Route::post('/Asset/sort', [assetController::class, 'sort']);
Route::post('/Asset/filter', [assetController::class, 'filter']);

Route::resource('/MaintenanceManagement', maintenanceController::class);
Route::get('/maintenanceManagement/list', [maintenanceController::class, 'list']);

Route::resource('/Budget', budgetController::class);

Route::resource('/VendorManagement', vendorController::class);
Route::resource('/LocationManagement', locationController::class);


