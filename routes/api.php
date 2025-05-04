<?php

use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\FolderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('folders')->controller(FolderController::class)->group(function () {
        Route::get('/', 'index')->name('api.folders.index');
        Route::post('/', 'store')->name('api.folders.create');
        Route::patch('/{folder}', 'update')->name('api.folders.update');
        Route::delete('/{folder}', 'destroy')->name('api.folders.delete');
    });

    Route::prefix('files')->controller(FileController::class)->group(function () {
        Route::post('/', 'store')->name('api.files.create');
        Route::patch('/{file}', 'update')->name('api.files.update');
        Route::delete('/{file}', 'destroy')->name('api.files.delete');
    });

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->name('api.user');
});
