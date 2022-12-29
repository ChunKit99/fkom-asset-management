<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\vendorController;
use App\Http\Controllers\locationController;

use App\Http\Controllers\assetController;

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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::resource('/Asset', assetController::class);
Route::get('/asset/search', [assetController::class, 'search']);
Route::get('/asset/pdf', [assetController::class, 'createPDF']);
Route::post('/Asset/sort', [assetController::class, 'sort']);

Route::resource('/VendorManagement', vendorController::class);
Route::resource('/LocationManagement', locationController::class);
