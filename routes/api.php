<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SaleController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\ProductController;


Route::apiResource('products', ProductController::class);

Route::get('reports/financial', [ReportController::class, 'financial']);

Route::apiResource('sales', SaleController::class);

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
