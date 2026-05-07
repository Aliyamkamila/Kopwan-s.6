<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InspectionLogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth routes (public)
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// Protected routes (require token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    
    Route::get('/inspections', [InspectionLogController::class, 'index']);
    Route::post('/inspections', [InspectionLogController::class, 'store']);
    Route::get('/inspections/{id}', [InspectionLogController::class, 'show']);
    Route::put('/inspections/{id}', [InspectionLogController::class, 'update']);
    Route::delete('/inspections/{id}', [InspectionLogController::class, 'destroy']);
    Route::get('/inspections/stats/summary', [InspectionLogController::class, 'summary']);
});

// Health check (public)
Route::get('/health', function () {
    return response()->json(['status' => 'ok', 'timestamp' => now()]);
});