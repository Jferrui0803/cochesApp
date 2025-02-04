<?php

use App\Http\Controllers\CocheController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CocheController::class, 'index'])->name('index');
