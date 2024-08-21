<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CostHandleController;
use App\Models\Investment;

Route::get('/', function () {
    $investment = Investment::all();
    return view('index', ['investments'=>$investment]);
});

Route::post('/about', [CostHandleController::class, 'storeData'])->name('about');