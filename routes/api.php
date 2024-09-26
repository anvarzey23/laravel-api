<?php

use App\Http\Controllers\ClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/', function() {
    return 'Hello from API';
});

// -------- CREATE CLIENT --------
Route::post('clients', [ClientController::class, 'store']);

// -------- GET ALL CLIENTS --------
Route::get('clients', [ClientController::class, 'index']);

// -------- GET SPECIFIC CLIENT --------
Route::get('clients/{client}', [ClientController::class, 'show'])
->missing(function() {
    return response('Client not found', 404);
});

// -------- UPDATE ALL CLIENT'S INFORMATION --------
Route::put('clients/{client}', [ClientController::class, 'update'])
->missing(function() {
    return response('Client not found', 404);
});

// -------- UPDATE CLIENT'S SPECIFIC PIECE OF DATA --------
Route::patch('clients/{client}', [ClientController::class, 'updateSpecific'])
->missing(function() {
    return response('Client not found', 404);
});

// -------- DELETE CLIENT --------
Route::delete('clients/{client}', [ClientController::class, 'destroy'])
->missing(function() {
    return response('Client not found', 404);
});