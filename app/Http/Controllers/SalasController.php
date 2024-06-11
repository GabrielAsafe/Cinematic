<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalaRequest;
use App\Models\Sala;
use Illuminate\Http\Request;

class SalasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterByNome = $request->nome ?? '';
        $salaQuery = Sala::query();

        if ($filterByNome !== '') {
            $salaID = Sala::where('nome', 'like', "%$filterByNome%")->pluck('id');
            //$filmeId = $filterByTitulo ? Filme::where('titulo', 'like', "%$filterByTitulo%")->pluck('id') : Filme::where('sumario', 'like', "%$filterByTitulo%")->pluck('id');
            //return $filmeId;
            $salaQuery->whereIntegerInRaw('id', $salaID);
        }

        $salas = $salaQuery->paginate(10);
        return view('salas.index', compact('salas', 'filterByNome'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $sala = new Sala();

        return view('salas.create', compact('sala'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SalaRequest $request)
    {
        $newSala = Sala::create($request->validated());

        $quantidade = $request['quantidade'];

        for ($i = 1; $i <= $quantidade; $i++) {
            $fila = chr(64 + ceil($i / 10)); // ceil avança para o integer + próximo
            $posicao = ($i - 1) % 10 + 1; // 1 - 1 = 0 %10 = 0 +1 = 1 | 2 -1 = 1 %10 = 1 +1 = 2

            // Create the lugar
            $newSala->lugares()->create([
                'fila' => $fila,
                'posicao' => $posicao,
            ]);
        }

        $url = route('salas.show', ['sala' => $newSala]);
        $htmlMessage = "Sala <a href='$url'>#{$newSala->id}</a><strong>\"{$newSala->nome}\"</strong> foi criada com sucesso!";
        return redirect()->route('salas.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sala $sala)
    {
        return view('salas.show', compact('sala'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sala $sala)
    {
        return view('salas.edit', compact('sala'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SalaRequest $request, Sala $sala)
    {
        $sala->update($request->validated());

        $url = route('salas.show', ['sala' => $sala]);
        $htmlMessage = "Sala <a href='$url'>#{$sala->id}</a><strong>\"{$sala->nome}\"</strong> foi alterada com sucesso!";
        return redirect()->route('salas.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sala $sala)
    {
        try {
            $sala->delete();
            $alertType = 'success';
            $htmlMessage = "Sala #{$sala->id}
            <strong>\"{$sala->nome}\"</strong> foi apagado com sucesso!";
        } catch (\Exception $error) {
            $url = route('salas.show', ['sala' => $sala]);
            $htmlMessage = "Não foi possível apagar o filme
            <a href='$url'>#{$sala->id}</a>
            <strong>\"{$sala->nome}\"</strong> porque ocorreu um erro!";
            $alertType = 'danger';
        }
        return redirect()->route('salas.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }
}
