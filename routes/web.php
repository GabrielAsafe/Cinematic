<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmesController;

Route::view('/', 'home')->name('root');

Route::resource('filmes', FilmesController::class);//tem todos os comandos de crud associados

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
