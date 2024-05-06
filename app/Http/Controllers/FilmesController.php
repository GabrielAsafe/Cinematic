<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use App\Models\Genero;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class FilmesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $filmes = Filme::all();
        debug($filmes);
        Log::debug('Cursos has been loaded on the controller.', ['$allCursos' => $filmes]);
        return view('filmes.index')->with('filmes', $filmes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $filme = new Filme();
        $generos = Genero::all();

        return view('filmes.create', compact('filme', 'generos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required',
            'genero_code' => 'required|exists:generos,code',
            'ano' => 'required',
            'cartaz_url' => 'required',
            'sumario' => 'required',
            'trailer_url' => 'required'
            ]);

        Filme::create($validated);
        return redirect()->route('filmes.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Filme $filme)
    {
        return view('filmes.show', compact('filme'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Filme $filme)
    {
        $generos = Genero::all();
        return view('filmes.edit', compact('filme', 'generos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Filme $filme)
    {
        $filme->update($request->all());
        return redirect()->route('filmes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Filme $filme)
    {
        $filme->delete();
        return redirect()->route('filmes.index');
    }
}
