<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BilhetesController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\FilmesController;
use App\Http\Controllers\LugaresController;
use App\Http\Controllers\RecibosController;
use App\Http\Controllers\SalasController;
use App\Http\Controllers\SessoesController;
use Illuminate\Support\Facades\Auth;

use App\Mail\MyTestEmail;
use Illuminate\Support\Facades\Mail;

Route::view('/', 'home')->name('root');

Route::resource('bilhetes', BilhetesController::class);//tem todos os comandos de crud associados
Route::resource('clientes', ClientesController::class);//tem todos os comandos de crud associados
Route::delete('clientes/{cliente}/foto', [ClientesController::class, 'destroy_foto'])->name('clientes.foto.destroy');

Route::resource('filmes', FilmesController::class);//tem todos os comandos de crud associados
Route::delete('filmes/{filme}/cartaz', [FilmesController::class, 'destroy_cartaz'])->name('filmes.cartaz.destroy');
Route::get('filmes/{filme}/novaSessao', [SessoesController::class, 'create'])->name('filmes.sessao.create');
Route::post('filmes/{filme}/novaSessao', [SessoesController::class, 'store'])->name('filmes.sessao.store');

Route::get('/sessoes/{sessaoId}/lugares-vazios', [SessoesController::class, 'getLugaresVazios'])->name('sessoes.getLugaresVazios');

Route::resource('lugares', LugaresController::class);//tem todos os comandos de crud associados
Route::resource('recibos', RecibosController::class);//tem todos os comandos de crud associados
Route::resource('salas', SalasController::class);//tem todos os comandos de crud associados

Route::resource('sessoes', SessoesController::class);//tem todos os comandos de crud associados


Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/password/change', [ChangePasswordController::class, 'show'])->name('password.change.show');
Route::post('/password/change', [ChangePasswordController::class, 'store'])->name('password.change.store');


// Add a "lugares" to the cart:
Route::post('cart/{lugar}', [CartController::class, 'addToCart'])
    ->name('cart.add');
// Remove a "lugar" from the cart:
Route::delete('cart/{lugar}', [CartController::class, 'removeFromCart'])
    ->name('cart.remove');
// Show the cart:

// Confirm (store) the cart and save disciplinas registration on the database:
Route::post('cart', [CartController::class, 'store'])->name('cart.store');
// Clear the cart:
Route::delete('cart', [CartController::class, 'destroy'])->name('cart.destroy');


Route::post('validatePayment', [CartController::class, 'validatePayment'])->name('cart.validatePayment');


Route::get('cart', [CartController::class, 'show'])->name('cart.show');





Route::get('bilhetes/createPDF/{bilhete}', [BilhetesController::class, 'createPDF'])->name('createPDF');


