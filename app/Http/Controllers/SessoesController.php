<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use App\Models\Lugar;
use App\Models\Sessao;
use Illuminate\Http\Request;
use Illuminate\View\View;
use stdClass;

class SessoesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $filme) :View
    {



        $id =  $filme->all();

        $sessoes = Sessao::where('filme_id',$id)->get();




        return view('sessoes.index')->with(['sessoes'=> $sessoes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Sessao $sesso)
    {
        $filme = $sesso->filmeRef;
        return view('sessoes.show', compact('sesso', 'filme'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sessao $sessao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sessao $sessao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sessao $sessao)
    {
        //
    }
}
