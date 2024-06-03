<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) : View
    {
        $filterByNome = $request->name ?? '';
        $clienteQuery = Cliente::query();
        if ($filterByNome !== '') {
            $userIds = User::where('name', 'like', "%$filterByNome%")->pluck('id');
            $clienteQuery->whereIntegerInRaw('id', $userIds);
        }
        $clientes = $clienteQuery->with('user')->paginate(10);
        return view('Clientes.index', compact('clientes', 'filterByNome'));
    }

    // /**
    //  * Display the specified resource.
    //  */
    public function show(Cliente $cliente): View
    {
        return view('clientes.show', compact('cliente'));
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    public function edit(Cliente $cliente): View
    {
        return view('clientes.edit', compact('cliente'));
    }

    // /**
    //  * Update the specified resource in storage.
    //  */
    public function update(ClienteRequest $request, Cliente $cliente): RedirectResponse
    {
        $formData = $request->validated();
        $cliente = DB::transaction(function () use ($formData, $cliente, $request) {
            $cliente->nif = $formData['nif'];
            $cliente->tipo_pagamento = $formData['tipo_pagamento'];
            $cliente->ref_pagamento = $formData['ref_pagamento'];
            $cliente->save();
            $user = $cliente->user;
            $user->tipo = 'C';
            $user->name = $formData['name'];
            $user->email = $formData['email'];
            $user->bloqueado = $formData['bloqueado'];
            $user->save();
            if ($request->hasFile('file_foto')) {
                if ($user->foto_url) {
                    Storage::delete('public/fotos/' . $user->foto_url);
                }
                $path = $request->file_foto->store('public/fotos');
                $user->foto_url = basename($path);
                $user->save();
            }
            return $cliente;
        });
        $url = route('clientes.show', ['cliente' => $cliente]);
        $htmlMessage = "Cliente <a href='$url'>#{$cliente->id}</a>
                        <strong>\"{$cliente->user->name}\"</strong> foi alterado com sucesso!";
        return redirect()->route('clientes.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy(Cliente $cliente): RedirectResponse
    {
        try {
            $user = $cliente->user;
            DB::transaction(function () use ($cliente, $user) {
                $cliente->delete();
                $user->delete();
            });
            $htmlMessage = "cliente #{$cliente->id}
                        <strong>\"{$user->name}\"</strong> foi apagado com sucesso!";
            return redirect()->route('clientes.index')
                ->with('alert-msg', $htmlMessage)
                ->with('alert-type', 'success');
        } catch (\Exception $error) {
            $url = route('clientes.show', ['cliente' => $cliente]);
            $htmlMessage = "Não foi possível apagar o cliente <a href='$url'>#{$cliente->id}</a>
                        <strong>\"{$user->name}\"</strong> porque ocorreu um erro!";
            $alertType = 'danger';
        }
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }

    public function destroy_foto(Cliente $cliente): RedirectResponse
    {
        if ($cliente->user->url_foto) {
            Storage::delete('public/fotos/' . $cliente->user->url_foto);
            $cliente->user->url_foto = null;
            $cliente->user->save();
        }
        return redirect()->route('Clientes.edit', ['Cliente' => $cliente])
            ->with('alert-msg', 'Foto do Cliente "' . $cliente->user->name . '" foi removida!')
            ->with('alert-type', 'success');
    }
}
