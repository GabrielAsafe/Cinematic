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
    public function store(Request $request)
    {
        $sala = Sala::find($request['sala_id']);
        $quantidade = $request['quantidade'];


        $ultimoLugar = $sala->lugares()->orderBy('fila', 'desc')->orderBy('posicao', 'desc')->first();

        if ($ultimoLugar) {
            $ultimaFila = ord($ultimoLugar->fila) - 64;
            $ultimaPosicao = $ultimoLugar->posicao;
            $start = ($ultimaFila - 1) * 20 + $ultimaPosicao;
        } else {
            $start = 0;
        }

        for ($i = $start + 1; $i <= $start + $quantidade; $i++) {
            $fila = chr(64 + ceil($i / 20));
            $posicao = ($i - 1) % 20 + 1;

            // Create the lugar
            $sala->lugares()->create([
                'fila' => $fila,
                'posicao' => $posicao,
            ]);
        }

        $htmlMessage = "<strong>{$quantidade}</strong> lugares foram criados com sucesso!";
        return redirect()->route('salas.edit', ['sala' => $sala])
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
