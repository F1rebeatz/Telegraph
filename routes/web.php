<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TextController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return redirect()->route('models.index');
});
Route::get('/models', [TextController::class, 'index'])->name('models.index');
Route::get('models/create', [TextController::class, 'create'])->name('models.create');
Route::post('/models', [TextController::class, 'store'])->name('models.store');
Route::get('/models/{model}', [TextController::class, 'show'])->name('models.show');
Route::get('models/{model}/edit', [TextController::class, 'edit'])->name('models.edit');
Route::patch('/models/{model}', [TextController::class, 'update'])->name('models.update');
Route::delete('/models/{model}', [TextController::class, 'destroy'])->name('models.destroy');
