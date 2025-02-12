<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CocheController;

Route::get('/', [CocheController::class, 'index'])->name('index');
Route::get('carrito/{coche}', [CarritoController::class, 'add'])->name('carrito.add');