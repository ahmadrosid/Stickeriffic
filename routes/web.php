<?php

use App\Http\Controllers\GenerationController;
use App\Http\Controllers\ProfileController;
use App\Models\Sticker;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    $stickers = Sticker::orderBy('id', 'desc')->get();
    return view('dashboard', compact('stickers'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('generate', [GenerationController::class, 'generate'])->name('generate');
    Route::get('generate/get/{sticker}', [GenerationController::class, 'getGeneration'])->name('generate.get');
});

require __DIR__.'/auth.php';
