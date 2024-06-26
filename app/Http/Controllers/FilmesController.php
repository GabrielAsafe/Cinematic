<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use App\Models\Genero;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\FilmeRequest;
use Faker\Core\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Sala;
use App\Models\Sessao;

class FilmesController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Filme::class, 'filme');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $generos = Genero::all();
        $filterByGenero = $request->genero_code ?? '';
        $filterByTitulo = $request->titulo ?? '';
        $filterbySumario = $request->sumario ?? '';
        $filmeQuery = Filme::query();

        $filmeQuery->whereHas('sessoes', function ($query) {
            $query->whereDate('data', '>=', now()->toDateString());
        });

        if ($filterByGenero !== '') {
            $filmeQuery->where('genero_code', $filterByGenero);
        }
        if ($filterByTitulo !== '') {
            $filmeId = Filme::where('titulo', 'like', "%$filterByTitulo%")->pluck('id');
            //$filmeId = $filterByTitulo ? Filme::where('titulo', 'like', "%$filterByTitulo%")->pluck('id') : Filme::where('sumario', 'like', "%$filterByTitulo%")->pluck('id');
            //return $filmeId;
            $filmeQuery->whereIntegerInRaw('id', $filmeId);
        }
        if ($filterbySumario !== '') {
            $filmeId = Filme::where('sumario', 'like', "%$filterbySumario%")->pluck('id');
            $filmeQuery->whereIntegerInRaw('id', $filmeId);
        }

        $filmes = $filmeQuery->with('generoRef')->paginate(10);
        return view('filmes.index', compact('filmes', 'generos', 'filterByGenero', 'filterByTitulo', 'filterbySumario'));
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
    public function store(FilmeRequest $request): RedirectResponse
    {
        $newFilme = Filme::create($request->validated());

        if ($request->hasFile('file_cartaz')) {

            $path = $request->file_cartaz->store('public/cartazes');
            $newFilme->cartaz_url = basename($path);
            $newFilme->save();
        }

        $this->criarSessoes($newFilme);

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

        if ($request->hasFile('file_cartaz')) {

            if ($filme->cartaz_url) {
                Storage::delete('public/cartazes/' . $filme->cartaz_url);
            }

            $path = $request->file_cartaz->store('public/cartazes');
            $filme->cartaz_url = basename($path);
            $filme->save();
        }

        $url = route('filmes.show', ['filme' => $filme]);
        $htmlMessage = "filme <a href='$url'>#{$filme->id}</a><strong>\"{$filme->titulo}\"</strong> foi alterada com sucesso!";
        return redirect()->route('filmes.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    public function criarSessoes(Filme $filme){
        {
            $sessao = new Sessao();
            // Busca todas as salas disponíveis
            $salas = Sala::all();

            // Define o número máximo de dias após a criação do filme
            $diasMaximos = 10;

            // Quantidade de sessões a criar
            $quantidadeSessoes = 5;

            // Array para armazenar as mensagens de feedback
            $mensagens = [];

            // Loop para criar as sessões
            for ($i = 0; $i < $quantidadeSessoes; $i++) {
                // Escolhe uma sala aleatoriamente
                $sala = $salas->random();

                // Calcula uma data aleatória até 5 dias após a criação do filme
                $dataAleatoria = $filme->created_at->addDays(rand(1, $diasMaximos));

                // Gera um horário de início aleatório entre 12:00:00 e 23:59:59
                $horarioAleatorio = sprintf('%02d:%02d:%02d', rand(12, 23), rand(0, 59), rand(0, 59));

                // Cria a sessão

                $sessao = new Sessao();
                $sessao->filme_id = $filme->id;
                $sessao->sala_id = $sala->id;
                $sessao->data = $dataAleatoria;
                $sessao->horario_inicio = $horarioAleatorio;
                $sessao->save();

                // Adiciona uma mensagem de feedback
                $mensagens[] = "Sessão criada para o filme {$filme->titulo}: Sala {$sala->nome}, Data {$dataAleatoria->format('Y-m-d')}, Horário {$horarioAleatorio}";
            }

            // Retorna as mensagens de feedback
            return $mensagens;
        }
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
                $this->destroy_cartaz($filme);

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

    public function destroy_cartaz(Filme $filme): RedirectResponse
    {
        if ($filme->cartaz_url) {
            Storage::delete('public/cartazes/' . $filme->cartaz_url);
            $filme->cartaz_url = null;
            $filme->save();
        }
        return redirect()->route('filmes.edit', ['filme' => $filme])
            ->with('alert-msg', 'Cartaz do filme "' . $filme->titulo . '" foi removido!')
            ->with('alert-type', 'success');
    }

    public function estatistica (Filme $filme) : RedirectResponse {

    }
}