<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CostHandleController;
use App\Models\Investment;
use Carbon\Carbon;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::any('/', [CostHandleController::class, 'index'])->name('index');

    Route::post('/about', [CostHandleController::class, 'storeData'])->name('about');
    Route::post('/edit', [CostHandleController::class, 'edit'])->name('edit');
    Route::post('/delete', [CostHandleController::class, 'delete'])->name('delete');
});

require __DIR__.'/auth.php';
