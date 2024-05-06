<?php

use App\Http\Controllers\BilhetesController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\FilmeController;
use App\Http\Controllers\FilmesController;
use App\Http\Controllers\LugaresController;
use App\Http\Controllers\RecibosController;
use App\Http\Controllers\SalasController;
use App\Http\Controllers\SessoesController;
use App\Http\Controllers\UsersController;
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
Route::resource('clientes', ClientesController::class);//tem todos os comandos de crud associados
Route::resource('filmes', FilmesController::class);//tem todos os comandos de crud associados

Route::resource('lugares', LugaresController::class);//tem todos os comandos de crud associados
Route::resource('recibos', RecibosController::class);//tem todos os comandos de crud associados
Route::resource('salas', SalasController::class);//tem todos os comandos de crud associados

Route::resource('sessoes', SessoesController::class);//tem todos os comandos de crud associados
Route::resource('users', UsersController::class);//tem todos os comandos de crud associados


Route::resource('/', FilmesController::class);//tem todos os comandos de crud associados
