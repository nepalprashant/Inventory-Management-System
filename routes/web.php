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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/company', [App\Http\Controllers\CompanyController::class, 'index'])->name('company.index')->middleware('auth');
Route::get('/company/create', [App\Http\Controllers\CompanyController::class, 'create'])->name('company.create')->middleware('auth');
Route::post('/company/save', [App\Http\Controllers\CompanyController::class, 'store'])->name('company.save')->middleware('auth');
Route::get('company/edit/{id}', [App\Http\Controllers\CompanyController::class, 'edit'])->name('company.edit')->middleware('auth');
Route::post('/company/upadate/{id}', [App\Http\Controllers\CompanyController::class, 'update'])->name('company.update')->middleware('auth');

Route::get('/customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer.index')->middleware('auth');
Route::get('/customer/create', [App\Http\Controllers\CustomerController::class, 'create'])->name('customer.create')->middleware('auth');
Route::post('/customer/save', [App\Http\Controllers\CustomerController::class, 'store'])->name('customer.save')->middleware('auth');
Route::get('/customer/edit/{id}', [App\Http\Controllers\CustomerController::class, 'edit'])->name('customer.edit')->middleware('auth');
Route::post('/customer/update/{id}', [App\Http\Controllers\CustomerController::class, 'update'])->name('customer.update')->middleware('auth');

Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('product.index')->middleware('auth');
Route::get('/product/create', [App\Http\Controllers\ProductController::class, 'create'])->name('product.create')->middleware('auth');
Route::post('/product/save', [App\Http\Controllers\ProductController::class, 'store'])->name('product.save')->middleware('auth');
Route::get('/product/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit')->middleware('auth');
Route::post('/product/update/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('product.update')->middleware('auth');

Route::get('/supplier', [App\Http\Controllers\SupplierController::class, 'index'])->name('supplier.index')->middleware('auth');
Route::get('/supplier/create', [App\Http\Controllers\SupplierController::class, 'create'])->name('supplier.create')->middleware('auth');
Route::post('/supplier/save', [App\Http\Controllers\SupplierController::class, 'store'])->name('supplier.save')->middleware('auth');
Route::get('/supplier/edit/{id}', [App\Http\Controllers\SupplierController::class, 'edit'])->name('supplier.edit')->middleware('auth');
Route::post('/supplier/update/{id}', [App\Http\Controllers\SupplierController::class, 'update'])->name('supplier.update')->middleware('auth');

Route::get('/purchase', [App\Http\Controllers\PurchaseController::class, 'index'])->name('purchase.index')->middleware('auth');
Route::get('/purchase/create', [App\Http\Controllers\PurchaseController::class, 'create'])->name('purchase.create')->middleware('auth');
Route::post('/purchase/save', [App\Http\Controllers\PurchaseController::class, 'store'])->name('purchase.save')->middleware('auth');


Route::get('/stock', [App\Http\Controllers\PurchaseDetailController::class, 'index'])->name('purchaseDetail.index')->middleware('auth');

Route::get('/purchaseItem/create/{var}', [App\Http\Controllers\PurchaseItemController::class, 'create'])->name('purchaseItem.create')->middleware('auth');
Route::post('/purchaseItem/save/{id}', [App\Http\Controllers\PurchaseItemController::class, 'store'])->name('purchaseItem.save')->middleware('auth');
Route::post('/purchaseItem/statement/{id}', [App\Http\Controllers\PurchaseItemController::class, 'show'])->name('purchaseItem.show')->middleware('auth');
Route::get('/purchaseItem/delete/{id}/{pid}', [App\Http\Controllers\PurchaseItemController::class, 'destroy'])->name('purchaseItem.delete')->middleware('auth');
Route::get('/purchaseItem/billing/{id}', [App\Http\Controllers\PurchaseItemController::class, 'display'])->name('purchaseItem.final')->middleware('auth');

Route::get('purchase/return/{id}/{pid}', [App\Http\Controllers\PurchaseDetailController::class, 'create'])->name('purchaseReturn.create')->middleware('auth');
Route::post('purchase/return/save/{pid}', [App\Http\Controllers\PurchaseDetailController::class, 'store'])->name('purchaseReturn.save')->middleware('auth');
Route::post('purchase/return/bill/{pid}', [App\Http\Controllers\PurchaseDetailController::class, 'show'])->name('purchaseReturnBill.show')->middleware('auth');

Route::get('supplierLedger/', [App\Http\Controllers\SupplierLedgerController::class, 'index'])->name('supplierLedger.index')->middleware('auth');
Route::post('supplierLedger/details', [App\Http\Controllers\SupplierLedgerController::class, 'show'])->name('supplierLedger.show')->middleware('auth');

Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

