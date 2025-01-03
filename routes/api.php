<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get_all_invoice', [InvoiceController::class, 'get_all_invoice']);
Route::get('/search_invoice', [InvoiceController::class, 'search_invoice']);
Route::get('/new_invoice', [InvoiceController::class, 'new_invoice']);
Route::get('/all_customers', [CustomerController::class, 'all_customers']);
Route::post('/add_customer', [CustomerController::class, 'add_customer']);
Route::get('/get_all_products', [ProductController::class, 'get_all_products']);
Route::get('/add_new_product', [ProductController::class, 'add_new_product']);
Route::post('/add_product', [ProductController::class, 'add_product']);
Route::post('/add_invoice', [InvoiceController::class, 'add_invoice']);
Route::get('/show_invoice/{id}', [InvoiceController::class, 'show_invoice']);
Route::get('/get_edit_data/{id}', [InvoiceController::class, 'get_edit_data']);
Route::post('/update_invoice', [InvoiceController::class, 'update_invoice']);