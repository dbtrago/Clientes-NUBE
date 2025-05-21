<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;

// Listar clientes
Route::get('/', [ClienteController::class, 'index'])->name('clientes.index');

// Crear nuevo cliente
Route::get('/nuevo', [ClienteController::class, 'create'])->name('clientes.create');
Route::post('/guardar', [ClienteController::class, 'store'])->name('clientes.store');

// Editar cliente
Route::get('/editar/{cliente}', [ClienteController::class, 'edit'])->name('clientes.edit');
Route::put('/actualizar/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');

// Eliminar cliente
Route::delete('/eliminar/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
