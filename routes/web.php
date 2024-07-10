<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RouteController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

Route::get('/', [RouteController::class, 'index'])->middleware(['auth', 'verified'])->name('home');
Route::post('/calculate', [RouteController::class, 'calculate'])->name('routes.calculate');
Route::get('/routes', [RouteController::class, 'show'])->name('routes.show');
Route::get('/routes/create', [RouteController::class, 'create'])->name('routes.create');
Route::post('/routes/store', [RouteController::class, 'store'])->name('routes.store');
Route::get('/routes/{id}/edit', [RouteController::class, 'edit'])->name('routes.edit');
Route::post('/routes/{id}/update', [RouteController::class, 'update'])->name('routes.update');
Route::delete('/routes/{id}', [RouteController::class, 'destroy'])->name('routes.destroy');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
