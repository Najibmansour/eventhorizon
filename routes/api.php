<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use \App\Http\Controllers\API\EventPostController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Event Routes
// Route::get('/events', [\App\Http\Controllers\API\EventPostController::class, 'index']);
// Route::post('/events', [\App\Http\Controllers\API\EventPostController::class, 'store']);
// Route::get('/events/{id}', [\App\Http\Controllers\API\EventPostController::class, 'show']);
// Route::patch('/events/{id}/edit', [\App\Http\Controllers\API\EventPostController::class, 'update']);

// Route::resource('events', \App\Http\Controllers\API\EventPostController::class);
// Route::resource('events',\App\Http\Controllers\API\EventPostController::class)->only([
//     'index', 'show', 'store', 'update', 'destroy'
// ]);

Route::apiResource('events', EventPostController::class);

Route::fallback(function(){
    return response()->json(['message' => 'Not Found.'], 404);
});