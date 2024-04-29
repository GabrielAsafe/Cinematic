<?php

use App\Http\Controllers\BilhetesController;
use App\Http\Controllers\FilmeController;
use App\Http\Controllers\LugaresController;
use App\Http\Controllers\ReciboController;
use App\Http\Controllers\SessoesController;
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


/*
 * o que descobri:
 * o nome das totas tem que estar em minúsculas
 */

Route::resource('bilhetes', BilhetesController::class);//tem todos os comandos de crud associados
Route::resource('lugares', LugaresController::class);//tem todos os comandos de crud associados
Route::resource('sessoes', SessoesController::class);//tem todos os comandos de crud associados
Route::resource('recibos', ReciboController::class);//tem todos os comandos de crud associados
Route::resource('filmes', FilmeController::class);//tem todos os comandos de crud associados
Route::resource('/', FilmeController::class);//tem todos os comandos de crud associados
