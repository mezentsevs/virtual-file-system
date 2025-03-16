<?php

use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\FolderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(FolderController::class)->group(function () {
        Route::get('/folders', 'index')->name('folders.index');
        Route::post('/folders', 'store')->name('folders.create');
        Route::patch('/folders/{folder}', 'update')->name('folders.update');
        Route::delete('/folders/{folder}', 'destroy')->name('folders.delete');
    });

    Route::controller(FileController::class)->group(function () {
        Route::post('/files', 'store')->name('files.create');
        Route::patch('/files/{file}', 'update')->name('files.update');
        Route::delete('/files/{file}', 'destroy')->name('files.delete');
    });

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
