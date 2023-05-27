<?php

use App\Http\Controllers\UnauthorizedRequestController;
use App\Http\Controllers\v1\AccountController;
use App\Http\Controllers\v1\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

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

Route::get('/', function () {
    return response()->json([
        'success' => true,
        'message' => 'Welcome to ' . env('APP_NAME', 'Laravel')
    ], Response::HTTP_OK);
});

Route::get('unauthorized', UnauthorizedRequestController::class)->name('unauthorized');

Route::post('account/create', [AccountController::class, 'store']);
Route::post('authenticate', [LoginController::class, 'login']);
Route::get('user', [AccountController::class, 'getUser']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [LoginController::class, 'logout']);
});
