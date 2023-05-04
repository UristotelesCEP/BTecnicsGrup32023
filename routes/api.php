<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ProvinciaController;
use App\Http\Controllers\Api\ComarcaController;
use App\Http\Controllers\Api\MunicipiController;

use App\Http\Controllers\Api\CartesTrucadesController;
use App\Http\Controllers\Api\IncidentController;
use App\Http\Controllers\Api\TipusLocalitzacionsController;

Route::post('/cartes-trucades', [CartesTrucadesController::class, 'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/tipus-localitzacions', [TipusLocalitzacionsController::class, 'index']);

Route::get('/tipus_incidents', [IncidentController::class, 'index']);
Route::get('/tipus_incidents/{id}/incidents', [IncidentController::class, 'show']);

Route::get('/provincies', [ProvinciaController::class, 'index']);
Route::get('/provincies/{id}/comarques', [ProvinciaController::class, 'comarcas']);
Route::get('/comarques/{id}/municipis', [ComarcaController::class, 'municipis']);

Route::get('/expedients/{tel}/{idMun}/{incident}', [CartesTrucadesController::class,"getExpedients"]);
