<?php

namespace App\Http\Controllers;

use App\Models\Bilhete;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Object_;
use Illuminate\Support\Facades\Auth; // Add this line

class BilhetesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $clientId = $user->client_id; // Assuming the User model has a client_id field
        $bilhetes = Bilhete::where('cliente_id', $clientId)->get();

        return view('bilhetes.index', compact('bilhetes'));
    }

    public function show($id)
    {
        $bilhete = Bilhete::findOrFail($id);

        return view('bilhetes.show', compact('bilhete'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bilhetes = new Bilhete();//cria o array com todos os bilhetes para o utilizador assim que ele confirma os dados de pagamento
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
