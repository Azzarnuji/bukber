<?php

use App\Http\Controllers\Api\PaymentsApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('pembayaran')->group(function(){
    Route::post('/tambahPembayaran',[PaymentsApiController::class,'tambahPembayaran']);
    Route::get('/getAllPembayaran',[PaymentsApiController::class,'getAllPembayaran']);
    Route::get('/getTotalCash',[PaymentsApiController::class,'getTotalCash']);
    Route::delete('/hapusPembayaran/{id}',[PaymentsApiController::class,'deletePembayaran']);
});
