<?php

namespace App\Http\Controllers;

use App\Http\Requests\SessaoRequest;
use App\Models\Bilhete;
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

        //$formData = $request->validated();
        //array_push($formData, $filme->id);
        $newSessao = Sessao::create(array_merge($request->validated(), ['filme_id' =>$filme->id]));
        //print_r($formData);
        //die();
        //Sessao::create($formData);

        $url = route('filmes.show', ['filme' => $filme]);
        $htmlMessage = "Sessão <a href='$url'>#{$newSessao->id}</a><strong>\"{$filme->titulo}\"</strong> foi criada com sucesso!";
        return redirect()->route('filmes.show', ['filme' => $filme])
            ->with('filme', $filme)
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
        $sessao = Sessao::find($sessaoId);
        $filme = $sessao->filmeRef;

        $lugares = Lugar::where('sala_id', $sessao->sala_id)->get();

        // Obter os IDs dos lugares ocupados na sessão
        $ocupados = Bilhete::where('sessao_id', $sessaoId)->pluck('lugar_id');

        $lugaresVazios = $lugares->filter(function ($lugar) use ($ocupados) {
            return !$ocupados->contains($lugar->id);
        });



       return view('sessoes.show', ['lugaresVazios' => $lugaresVazios,'filme'=>$filme, 'sesso'=>$sessao]);

        return $lugaresVazios;
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sessao $sessao)
    {
        $sessao->delete();
        return redirect()->route('sessao.index');
    }
}
