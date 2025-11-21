<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServiciosApiController;
use App\Http\Controllers\Api\CitasApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\AgifyController;
use App\Http\Controllers\Api\TokenController;

// ==========================================
// RUTAS PÚBLICAS (sin autenticación)
// ==========================================
// Autenticación
Route::prefix('auth')->group(function () {
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
});
// Agify (sin protección)
Route::post('agify/predict', [AgifyController::class, 'apiPredict']);
// ==========================================
// RUTAS PROTEGIDAS (requieren autenticación)
// ==========================================
Route::middleware('auth:sanctum')->group(function () {
    // Gestión de Tokens
Route::get('tokens', [TokenController::class, 'index']);
Route::delete('tokens/{id}', [TokenController::class, 'destroy']);

// Perfil y logout
Route::prefix('auth')->group(function () {
Route::get('profile', [AuthController::class, 'profile']);
Route::put('profile', [AuthController::class, 'updateProfile']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('logout-all', [AuthController::class, 'logoutAll']);
});


Route::get('servicios', [ServiciosApiController::class, 'index']);
Route::get('servicios/{id}', [ServiciosApiController::class, 'show']);
Route::post('servicios', [ServiciosApiController::class, 'store']);
Route::put('servicios/{id}', [ServiciosApiController::class, 'update']);
Route::delete('servicios/{id}', [ServiciosApiController::class, 'destroy']);
Route::get('citas', [CitasApiController::class, 'index']);
Route::get('citas/{id}', [CitasApiController::class, 'show']);
Route::post('citas', [CitasApiController::class, 'store']);
Route::put('citas/{id}', [CitasApiController::class, 'update']);
Route::delete('citas/{id}', [CitasApiController::class, 'destroy']);
Route::get('users', [UserApiController::class, 'index']);
Route::get('users/{id}', [UserApiController::class, 'show']);
Route::post('users', [UserApiController::class, 'store']);
Route::put('users/{id}', [UserApiController::class, 'update']);
Route::delete('users/{id}', [UserApiController::class, 'destroy']);
});