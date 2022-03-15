<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\SellerController;
use App\Http\Controllers\API\SaleController;
use App\Http\Controllers\API\SaleReportController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::resources([
    'sellers' => SellerController::class,
    'sales'   => SaleController::class,
]);

Route::get('sales-daile-report', [SaleReportController::class, 'dailyReport']);
