<?php

use App\Http\Controllers\Http\Controller\ViagemController;
use App\Http\Controllers\PickupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcomodationController;
use App\Http\Controllers\PacoteController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\SeuControlador;
use App\Http\Controllers\TourController;
use Barryvdh\DomPDF\Facade\Pdf;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



//Rotas para Gerar Pacote PDF - No formato Zipp
Route::get('/gerar-pacote-pdf/{atividadeId}', [PacoteController::class, 'imprimirPDFIndividual']);

Route::get('/gerar-pacote-pdf', [PacoteController::class, 'imprimirPDF']);

Route::post('/imprimir-atividade/{tipe}', [PacoteController::class, 'imprimirAtividadePDF']);
Route::post('/pdf', [PacoteController::class, 'generatePDF']);





    

