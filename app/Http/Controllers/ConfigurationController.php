<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfigurationRequest;
use App\Models\Configuracao;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $configs = Configuracao::all();
        return view('configuracao.index', compact('configs' ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function edit(Configuracao $configuracao)
    {
        return view('configuracao.edit', compact('configuracao' ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ConfigurationRequest $request, Configuracao $configuracao)
    {

        $configuracao->update(request()->validated());


        $htmlMessage = "Dados foram alterados com sucesso!";
        return redirect()->route('configuracao.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
