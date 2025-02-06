<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CocheController;
Route::get('/', function () {
    return view('base');
});

Route::get('/', [CocheController::class, 'index'])->name('index');