<?php

use App\Http\Controllers\Task\TaskController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'task'
], function () {
    Route::get('', [TaskController::class, 'index']);
    Route::get('{id}', [TaskController::class, 'show'])->where('id', '[0-9]+');
    Route::post('{id?}', [TaskController::class, 'store']);
    Route::delete('/{id}', [TaskController::class, 'destroy'])->where('id', '[0-9]+');
});
