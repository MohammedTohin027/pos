<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\DefaultController;
use App\Http\Controllers\Backend\InvoiceController;
use App\Http\Controllers\Backend\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\PurchaseController;
use App\Http\Controllers\Backend\StockController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\UnitController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    //  manage user route
    Route::prefix('users')->group(function () {
        Route::get('/view', [UserController::class, 'view'])->name('user.view');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('store', [UserController::class, 'store'])->name('user.store');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('delete/{id}', [UserController::class, 'delete'])->name('user.delete');
    });
    //  manage profile route
    Route::prefix('profiles')->group(function () {
        Route::get('/view', [ProfileController::class, 'view'])->name('profile.view');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('change.password');
        Route::post('/update-password', [ProfileController::class, 'updatePassword'])->name('update.password');
    });

    //  manage supplier route
    Route::prefix('suppliers')->group(function () {
        Route::get('/view', [SupplierController::class, 'view'])->name('supplier.view');
        Route::get('/create', [SupplierController::class, 'create'])->name('supplier.create');
        Route::post('store', [SupplierController::class, 'store'])->name('supplier.store');
        Route::get('edit/{id}', [SupplierController::class, 'edit'])->name('supplier.edit');
        Route::post('update/{id}', [SupplierController::class, 'update'])->name('supplier.update');
        Route::get('delete/{id}', [SupplierController::class, 'delete'])->name('supplier.delete');
    });
    //  manage customer route
    Route::prefix('customers')->group(function () {
        Route::get('/view', [CustomerController::class, 'view'])->name('customer.view');
        Route::get('/create', [CustomerController::class, 'create'])->name('customer.create');
        Route::post('store', [CustomerController::class, 'store'])->name('customer.store');
        Route::get('edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
        Route::post('update/{id}', [CustomerController::class, 'update'])->name('customer.update');
        Route::get('delete/{id}', [CustomerController::class, 'delete'])->name('customer.delete');
        Route::get('/credit', [CustomerController::class, 'creditCustomer'])->name('customer.credit');
        Route::get('/credit/pdf', [CustomerController::class, 'creditCustomerPdf'])->name('customer.credit.pdf');
        Route::get('/credit/invoice/edit/{invoice_id}', [CustomerController::class, 'creditCustomerInvoiceEdit'])->name('customer.credit.invoice.edit');
        Route::post('/credit/invoice/update/{invoice_id}', [CustomerController::class, 'creditCustomerInvoiceUpdate'])->name('customer.credit.invoice.update');
        Route::get('/credit/invoice/details/pdf/{invoice_id}', [CustomerController::class, 'creditCustomerInvoiceDetailsPdf'])->name('customer.credit.invoice.details.pdf');
        Route::get('/paid', [CustomerController::class, 'paidCustomer'])->name('customer.paid');
        Route::get('/paid/pdf', [CustomerController::class, 'paidCustomerPdf'])->name('customer.paid.pdf');
        Route::get('/wise/report', [CustomerController::class, 'customerWiseReport'])->name('customer.wise.report');
        Route::get('/wise/credit/report', [CustomerController::class, 'customerWiseCreditReport'])->name('customer.wise.credit.report');
        Route::get('/wise/paid/report', [CustomerController::class, 'customerWisePaidReport'])->name('customer.wise.paid.report');
    });
    //  manage unit route
    Route::prefix('units')->group(function () {
        Route::get('/view', [UnitController::class, 'view'])->name('unit.view');
        Route::get('/create', [UnitController::class, 'create'])->name('unit.create');
        Route::post('store', [UnitController::class, 'store'])->name('unit.store');
        Route::get('edit/{id}', [UnitController::class, 'edit'])->name('unit.edit');
        Route::post('update/{id}', [UnitController::class, 'update'])->name('unit.update');
        Route::get('delete/{id}', [UnitController::class, 'delete'])->name('unit.delete');
    });
    //  manage category route
    Route::prefix('categories')->group(function () {
        Route::get('/view', [CategoryController::class, 'view'])->name('category.view');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    });
    //  manage product route
    Route::prefix('products')->group(function () {
        Route::get('/view', [ProductController::class, 'view'])->name('product.view');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('store', [ProductController::class, 'store'])->name('product.store');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('update/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::get('delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    });

    //  default route
    Route::get('get-category', [DefaultController::class,'getCategory' ])->name('default.get-category');
    Route::get('get-product', [DefaultController::class,'getProduct' ])->name('default.get-product');
    Route::get('get-all-product', [DefaultController::class,'getAllProduct' ])->name('default.get-all-product');
    Route::get('get-stock', [DefaultController::class,'getStock' ])->name('check-product-stock');

    //  manage purchase route
    Route::prefix('purchases')->group(function () {
        Route::get('/view', [PurchaseController::class, 'view'])->name('purchase.view');
        Route::get('/create', [PurchaseController::class, 'create'])->name('purchase.create');
        Route::post('store', [PurchaseController::class, 'store'])->name('purchase.store');
        Route::get('delete/{id}', [PurchaseController::class, 'delete'])->name('purchase.delete');
        Route::get('/pending/list', [PurchaseController::class, 'purchasePendingList'])->name('purchase.pending.view');
        Route::get('/approve/{id}', [PurchaseController::class, 'approve'])->name('purchase.approve');
        Route::get('/report', [PurchaseController::class, 'purchaseReport'])->name('purchase.report');
        Route::get('/report/pdf', [PurchaseController::class, 'purchaseReportPdf'])->name('purchase.report.pdf');
    });

    //  manage invoice route
    Route::prefix('invoices')->group(function () {
        Route::get('/view', [InvoiceController::class, 'view'])->name('invoice.view');
        Route::get('/create', [InvoiceController::class, 'create'])->name('invoice.create');
        Route::post('store', [InvoiceController::class, 'store'])->name('invoice.store');
        Route::get('delete/{id}', [InvoiceController::class, 'delete'])->name('invoice.delete');
        Route::get('/pending/list', [InvoiceController::class, 'invoicePendingList'])->name('invoice.pending.view');
        Route::get('/approve/{id}', [InvoiceController::class, 'approve'])->name('invoice.approve');
        Route::post('/approve/store/{id}', [InvoiceController::class, 'approveStore'])->name('approvel.store');
        Route::get('/invoice/print/list', [InvoiceController::class, 'printInvoiceList'])->name('invoice.print.list');
        Route::get('/invoice/print/{id}', [InvoiceController::class, 'generate_pdf'])->name('invoice.print');
        Route::get('/daily/report', [InvoiceController::class, 'dailyReport'])->name('invoice.daily.report');
        Route::get('/daily/report/pdf', [InvoiceController::class, 'dailyReportPdf'])->name('invoice.daily.report.pdf');
    });
    //  manage invoice route
    Route::prefix('stock')->group(function () {
        Route::get('/report/view', [StockController::class, 'stockReport'])->name('stock.report');
        Route::get('/report/pdf', [StockController::class, 'stockReportPdf'])->name('stock.report.pdf');
        Route::get('/report/supplier/product/wise', [StockController::class, 'supplierProductWiseReport'])->name('stock.report.supplier.product.wise');
        Route::get('/report/supplier/wise/pdf', [StockController::class, 'supplierWiseReportPdf'])->name('stock.report.supplier.wise.pdf');
        Route::get('/report/product/wise/pdf', [StockController::class, 'ProductWiseReportPdf'])->name('stock.report.product.wise.pdf');
    });

});