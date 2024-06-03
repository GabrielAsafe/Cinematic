<?php

namespace App\Http\Controllers;

use App\Http\Requests\SessaoRequest;
use App\Models\Filme;
use App\Models\Lugar;
use App\Models\Sessao;
use App\Models\Sala;
use Illuminate\Http\Request;
use Illuminate\View\View;
use stdClass;

class SessoesController extends Controller
{
        
    /**
     * Show the form for creating a new resource.
     */
    public function create(Filme $filme)
    {
        $newSessao = new Sessao();
        $salas = Sala::all();
        return view('sessoes.create', compact('newSessao', 'filme', 'salas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Filme $filme, SessaoRequest $request)
    {

        $formData = $request->validated();
        array_push($formData, $filme->id);
        print_r($formData);
        die();
        Sessao::create($formData);
        
        $url = route('filmes.show', ['filme' => $filme]);
        $htmlMessage = "Sessão <a href='$url'>#{$sessao->id}</a><strong>\"{$filme->titulo}\"</strong> foi criada com sucesso!";
        return redirect()->route('filmes.show')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sessao $sesso)
    {
        $filme = $sesso->filmeRef;
        return view('sessoes.show', compact('sesso', 'filme'));
    }



    public function getLugaresVazios($sessaoId)
    {
        // Use a query builder para construir a query desejada
        $lugaresVazios = Lugar::select('lugares.sala_id', 'lugares.fila', 'lugares.posicao')
            ->join('salas', 'lugares.sala_id', '=', 'salas.id')
            ->join('sessoes', 'salas.id', '=', 'sessoes.sala_id')
            ->leftJoin('bilhetes', function($join) use ($sessaoId) {
                $join->on('bilhetes.lugar_id', '=', 'lugares.id')
                    ->where('bilhetes.sessao_id', '=', $sessaoId);
            })
            ->where('sessoes.id', $sessaoId)
            ->whereNull('bilhetes.lugar_id')
            ->get();

        return response()->json($lugaresVazios);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sessao $sessao)
    {
        return view('sessao.edit')->withSessao($sessao);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sessao $sessao)
    {
        $sessao->update($request->all());
        return redirect()->route('sessao.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sessao $sessao)
    {
        $sessao->delete();
        return redirect()->route('sessao.index');
    }
}
