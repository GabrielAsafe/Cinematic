<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use App\Models\Genero;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\FilmeRequest;
use Illuminate\Support\Facades\DB;

class FilmesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $filmes = Filme::paginate(10);
        return view('filmes.index', compact('filmes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $generos = Genero::all();

        $filme = new Filme();

        return view('filmes.create', compact('filme', 'generos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FilmeRequest $request)
    {
        $newFilme = Filme::create($request->validated());
        $url = route('filmes.show', ['filme' => $newFilme]);
        $htmlMessage = "Filme <a href='$url'>#{$newFilme->id}</a><strong>\"{$newFilme->titulo}\"</strong> foi criada com sucesso!";
        return redirect()->route('filmes.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Filme $filme)
    {
        $generos = Genero::all();
        return view('filmes.show', compact('filme', 'generos'));
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
    public function update(FilmeRequest $request, Filme $filme)
    {
        $filme->update($request->validated());
        $url = route('filmes.show', ['filme' => $filme]);
        $htmlMessage = "filme <a href='$url'>#{$filme->id}</a><strong>\"{$filme->titulo}\"</strong> foi alterada com sucesso!";
        return redirect()->route('filmes.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Filme $filme)
    {
        try {
            $totalSessoes = DB::scalar('select count(*)
            from sessoes where filme_id = ?', [$filme->id]);
            if ($totalSessoes == 0) {
                $filme->delete();
                $alertType = 'success';
                $htmlMessage = "Filme #{$filme->id}
            <strong>\"{$filme->titulo}\"</strong> foi apagado com sucesso!";
            } else {
                $url = route('filmes.show', ['filme' => $filme]);
                $alertType = 'warning';
                $sessoesSTR = $totalSessoes > 0 ?
                    ($totalSessoes == 1 ?
                        "1 sessão relacionada ao filme" :
                        "$totalSessoes sessões relacionadas ao filme") :
                    "";

                $htmlMessage = "Filme <a href='$url'>#{$filme->id}</a>
            <strong>\"{$filme->titulo}\"</strong>
            não pode ser apagada porque há $sessoesSTR!
            ";
            }
        } catch (\Exception $error) {
            $url = route('filmes.show', ['filme' => $filme]);
            $htmlMessage = "Não foi possível apagar o filme
            <a href='$url'>#{$filme->id}</a>
            <strong>\"{$filme->titulo}\"</strong> porque ocorreu um erro!";
            $alertType = 'danger';
        }
        return redirect()->route('filmes.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }
}