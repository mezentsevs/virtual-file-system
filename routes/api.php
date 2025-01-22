<?php

use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\FolderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/folders', [FolderController::class, 'index'])->name('folders.index');
    Route::post('/folders', [FolderController::class, 'store'])->name('folders.create');
    Route::patch('/folders/{folder}', [FolderController::class, 'update'])->name('folders.update');
    Route::delete('/folders/{folder}', [FolderController::class, 'destroy'])->name('folders.delete');

    Route::patch('/files/{file}', [FileController::class, 'update'])->name('files.update');
    Route::delete('/files/{file}', [FileController::class, 'destroy'])->name('files.delete');

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
