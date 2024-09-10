<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TblmusicasController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function () {
    return response()->json(['Sucesso' => true]);
});

Route::get('/musicas', [TblmusicasController::class, 'index']);
Route::get('/musicas/{codigo}', [TblmusicasController::class, 'show']);
Route::post('/musicas', [TblmusicasController::class, 'store']);
Route::put('/musicas/{codigo}', [TblmusicasController::class, 'update']);
Route::delete('/musicas/{codigo}', [TblmusicasController::class, 'destroy']);
