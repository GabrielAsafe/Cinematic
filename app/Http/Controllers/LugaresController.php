<?php

namespace App\Http\Controllers;

use App\Http\Requests\LugarRequest;
use App\Models\Lugar;
use App\Models\Sala;
use Illuminate\Http\Request;


class LugaresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $lugar = new lugar();
        $sala_id = $request['sala_id'];

        return view('lugares.create', compact('lugar', 'sala_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LugarRequest $request)
    {
        $newLugar = Lugar::create(array_merge($request->validated(), ['sala_id' => $request['sala_id']]));
        $sala = Sala::find($request['sala_id']);

        $htmlMessage = "Lugar <strong>\"{$newLugar->fila}{$newLugar->posicao}\"</strong> foi criado com sucesso!";
        return redirect()->route('salas.edit',['sala' => $sala])
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lugar $lugare)
    {
        return $lugare;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lugar $lugare)
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
    public function destroy(Lugar $lugare)
    {
        //
    }
}
