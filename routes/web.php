<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CostHandleController;
use App\Models\Investment;
use Carbon\Carbon;

Route::get('/', [CostHandleController::class, 'index']);

Route::post('/about', [CostHandleController::class, 'storeData'])->name('about');