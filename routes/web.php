<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VacanciesController;
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

Route::get('/', [VacanciesController::class, 'index'])->name('home');
Route::get('/vaga/{vacancy}', [VacanciesController::class, 'show'])->name('vacancy.show');

Route::get('/grupo-whatsapp', function(){
    return redirect('https://chat.whatsapp.com/GmYVwNOzS9v62GOlfMwXQJ');
})->name('whatsapp');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/publicar-vaga', [VacanciesController::class, 'store'])->middleware('auth')->name('vacancy.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
