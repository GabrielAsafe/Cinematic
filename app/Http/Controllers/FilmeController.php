<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class FilmeController extends Controller
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
        $newFilme = new Filme();
        return view('filmes.create')->with($newFilme);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Filme::create($request->all());
        return redirect()->route('filmes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Filme $filmes)
    {
        return view('filmes.show')->with($filmes);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Filme $filmes)
    {
        return view('filmes.edit')->with($filmes);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Filme $filmes)
    {
        $filmes->update($request->all());
        return redirect()->route('filmes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Filme $filmes)
    {
        $filmes->delete();
        return redirect()->route('filmes.index');
    }
}
