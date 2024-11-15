<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

// Ruta para verificar el nombre de usuario
Route::post('/check-username', [AuthController::class, 'checkUsername']);

// Ruta para login con limitación de 5 intentos por minuto
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');


// Middleware para JWT
Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Rutas protegidas para los CRUDs
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('positions', PositionController::class);
    Route::apiResource('employees', EmployeeController::class);
    Route::apiResource('users', UserController::class);
    
    // Ruta para logout
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::fallback(function () {
    return response()->json([
        'message' => 'Ruta no encontrada. Verifica tu API.',
    ], 404);
});

