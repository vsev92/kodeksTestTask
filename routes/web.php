<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NodeController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::resource('nodes', NodeController::class);
Route::get('nodesPlain', [NodeController::class, 'indexPlain'])->name('nodes.indexPlain');
