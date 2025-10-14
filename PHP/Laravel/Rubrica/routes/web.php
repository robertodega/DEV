<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RubricaController;

Route::get('/', [RubricaController::class, 'index']);
