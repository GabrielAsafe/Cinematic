<?php

namespace App\Http\Controllers;

use App\Models\Bilhete;
use App\Models\Recibo;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Object_;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\String\b;

// Add this line

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


// Generate PDF
    public static function createPDF(Bilhete $bilhete) {

        $recibo = Recibo::find($bilhete->recibo_id);


        $html = view('mail.mail', ['recibo' => $recibo])->render();



        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }


}
