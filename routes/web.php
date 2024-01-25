<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\MercadoPagoController;
use App\Http\Controllers\PaymentController;
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
Route::get('/grupo-whatsapp', function () {
    return redirect('https://chat.whatsapp.com/GmYVwNOzS9v62GOlfMwXQJ');
})->name('whatsapp');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/painel', [VacanciesController::class, 'dashboard'])->name('dashboard');
    Route::get('/nova-vaga', [VacanciesController::class, 'create'])->name('vacancy.create');
    Route::get('/editar-vaga/{vacancy}', [VacanciesController::class, 'edit'])->name('vacancy.edit');
    Route::post('/publicar-vaga', [VacanciesController::class, 'store'])->name('vacancy.store');
    Route::post('/atualizar-vaga/{vacancy}', [VacanciesController::class, 'update'])->name('vacancy.update');
    Route::get('/efetuar-pagamento-pre-visualizar/{vacancy}', [VacanciesController::class, 'makePayment'])->name('vacancy.make-payment');
    
    Route::get('/pagamento-efetuado/{product}/{id}', [PaymentController::class, 'paymentConfirmed'])->name('payment.success');
    Route::get('/pagamento-cancelado', [PaymentController::class, 'paymentCanceled'])->name('payment.cancel');
    
    Route::get('/efetuar-pagamento/{vacancy}', [MercadoPagoController::class, 'checkout'])->name('payment.checkout');
    Route::post('/processar-pagamento/{vacancy}', [MercadoPagoController::class, 'process'])->name('payment.process');
    Route::get('/previsualizar-vaga/{vacancy}', [VacanciesController::class, 'preview'])->name('vacancy.preview');
});

Route::post('/novo-candidato', [CandidateController::class, 'store'])->name('candidate.store');
Route::post('/webhook-mercado-pago-vaga-change-status', [MercadoPagoController::class, 'webhook'])->name('payment.webhook');

require __DIR__ . '/auth.php';
