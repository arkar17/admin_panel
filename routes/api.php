<?php

// use App\Http\Controllers\Auth\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiTwoDManageController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::post('/register', [ApiController::class, 'register']);
// Route::post('/login', [ApiController::class, 'login']);

// Route::middleware('auth:sanctum')->group(function() {
//     Route::post('/request-promotion', [ApiController::class, 'requestPromotion']);
//     Route::get('profile', [ApiController::class, 'profile']);
//     Route::post('2d-sale-lists', [ApiController::class, 'TwoDSaleList']);
// });


Route::get('/tDList', [ApiTwoDManageController::class, 'getTwoDs']);
