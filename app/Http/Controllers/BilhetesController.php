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


    public $timestamps = true;


    protected $fillable = ['recibo_id','cliente_id','sessao_id','lugar_id','preco_total_sem_iva','estado'];


    public function index()
    {
        $userId = Auth::id(); // Get the currently authenticated user's ID
        $bilhetes = Bilhete::where('cliente_id', $userId)->orderBy('id','DESC')->paginate(5); // Fetch all bilhetes for this user

        return view('bilhetes.index', compact('bilhetes'));
    }

    public function show($id)
    {
        $bilhete = Bilhete::findOrFail($id);

        return view('bilhetes.show', compact('bilhete'));
    }


}
