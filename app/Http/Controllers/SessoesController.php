<?php

namespace App\Http\Controllers;

use App\Models\Filme;
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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