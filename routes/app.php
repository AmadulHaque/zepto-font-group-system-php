<?php

use App\Facades\Route;
use App\Controllers\FontController;
use App\Controllers\FontGroupController;





Route::get('/', [FontController::class, 'index']); 
Route::get('/font/create', [FontController::class, 'create']);
Route::post('/font/delete', [FontController::class, 'delete']);
Route::post('/font/upload', [FontController::class, 'store']);

Route::get('/font/group', [FontGroupController::class, 'index']);
Route::get('/font/group/create', [FontGroupController::class, 'create']);
Route::get('/font/group/edit', [FontGroupController::class, 'edit']);
Route::post('/font/group/store', [FontGroupController::class, 'store']);
Route::post('/font/group/update', [FontGroupController::class, 'update']);
Route::post('/font/group/delete', [FontGroupController::class, 'delete']);