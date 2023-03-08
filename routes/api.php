<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/roles', [RoleController::class, 'index'])->middleware('auth:sanctum');
Route::post('/roles', [RoleController::class, 'store'])->middleware('auth:sanctum');
Route::get('/roles/{id}', [RoleController::class, 'show'])->middleware('auth:sanctum');
Route::put('/roles/{id}', [RoleController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->middleware('auth:sanctum');

Route::get('/permissions', [PermissionController::class, 'index'])->middleware('auth:sanctum');
Route::post('/permissions', [PermissionController::class, 'store'])->middleware('auth:sanctum');
Route::get('/permissions/{id}', [PermissionController::class, 'show'])->middleware('auth:sanctum');
Route::put('/permissions/{id}', [PermissionController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/permissions/{id}', [PermissionController::class, 'destroy'])->middleware('auth:sanctum');
