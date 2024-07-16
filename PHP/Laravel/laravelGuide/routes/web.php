<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;

Route::get('/', function () {
    #   return view('welcome');
    return view('home');
});


Route::get('dependencies', [PageController::class, 'dependencies']);
Route::get('project', [PageController::class, 'project']);
Route::get('controller', [PageController::class, 'controller']);
Route::get('views', [PageController::class, 'views']);
Route::get('bladeTemplates', [PageController::class, 'bladeTemplates']);
Route::get('paths', [PageController::class, 'paths']);
Route::get('routes', [PageController::class, 'routes']);