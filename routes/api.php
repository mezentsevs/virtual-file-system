<?php

use App\Http\Controllers\FolderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/folders', [FolderController::class, 'index'])->name('folders.index');

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
