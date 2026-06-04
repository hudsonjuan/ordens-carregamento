<?php

use App\Http\Controllers\DestinoController;
use App\Http\Controllers\FrotaController;
use App\Http\Controllers\MotoristaController;
use App\Http\Controllers\OrdemCarregamentoController;
use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// Motoristas
Route::resource('motoristas', MotoristaController::class);

// Destinos
Route::resource('destinos', DestinoController::class);

// Frotas
Route::resource('frotas', FrotaController::class);

// Ordens de Carregamento
Route::get('/ordens', [OrdemCarregamentoController::class, 'index'])->name('ordens.index');
Route::get('/ordens/create', [OrdemCarregamentoController::class, 'create'])->name('ordens.create');
Route::post('/ordens', [OrdemCarregamentoController::class, 'store'])->name('ordens.store');
Route::get('/ordens/{id}', [OrdemCarregamentoController::class, 'show'])->name('ordens.show');
Route::get('/ordens/{id}/preview', [OrdemCarregamentoController::class, 'preview'])->name('ordens.preview');
Route::get('/ordens/{id}/download', [OrdemCarregamentoController::class, 'download'])->name('ordens.download');
Route::post('/ordens/{id}/update-nf', [OrdemCarregamentoController::class, 'updateNf'])->name('ordens.updateNf');
Route::delete('/ordens/{id}', [OrdemCarregamentoController::class, 'destroy'])->name('ordens.destroy');
