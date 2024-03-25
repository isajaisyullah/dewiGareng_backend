<?php
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UmkmController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\GaleriController;
use App\Http\Controllers\API\WisataController;
use App\Http\Controllers\API\ProductController;

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

Route::apiResource('umkm', UmkmController::class);
Route::apiResource('posts', GaleriController::class);
Route::apiResource('items', ProductController::class);
Route::apiResource('packages', WisataController::class);

// custom API route
Route::get('storeProducts/{id}', [UmkmController::class, 'UmkmProduct']);

// Order API
Route::post('order', [OrderController::class, 'whatsAppMessage']);
