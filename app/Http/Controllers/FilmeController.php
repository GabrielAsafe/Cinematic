<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FilmeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $filmes = Filme::all();
        return view('filmes.index')->with('filmes', $filmes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $filme = new Filme();


        return view('filmes.create', compact('filme'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $filme = Filme::findOrFail($id);
        return view('filmes.show', compact('filme'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return "mais tetas";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
