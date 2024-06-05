<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\QRcodeController;
use App\Models\Bilhete;
use App\Models\Filme;
use App\Models\Lugar;
use App\Models\Recibo;
use App\Models\Sala;
use App\Models\Sessao;
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


    protected $fillable = ['recibo_id', 'cliente_id', 'sessao_id', 'lugar_id', 'preco_total_sem_iva', 'estado'];


    public function index()
    {
        $userId = Auth::id(); // Get the currently authenticated user's ID
        $bilhetes = Bilhete::where('cliente_id', $userId)
            ->where('estado', 'não usado')
            ->orderBy('id', 'DESC')
            ->paginate(5);

        return view('bilhetes.index', compact('bilhetes'));
    }

    public function show($id)
    {
        $bilhete = Bilhete::findOrFail($id);
        $sessao=Sessao::find($bilhete->sessao_id);

        $filme = Filme::find($sessao->filme_id);
        $sala = Sala::find($sessao->sala_id);
        $lugar = Lugar::find($bilhete->lugar_id);
        $recibo = Recibo::find($bilhete->recibo_id);


        return view('bilhetes.show', ['recibo' => $recibo, 'bilhete' => $bilhete,
            'fila' => $lugar->fila, 'posicao' => $lugar->posicao,
            'nome_sala' => $sala->nome, 'titulo' => $filme->titulo,
            'sessao'=>$sessao
        ])->render();

        return view('bilhetes.show', compact('bilhete','sessao','filme','sala','lugar','recibo','fila','posicao','nome_sala'));
    }


// Generate PDF
    public static function createPDF(Bilhete $bilhete)
    {

        //podia ser de boas mas o corno pede essas merdas aqui para a sub-section do bilhete
        $sessao = Sessao::find($bilhete->sessao_id);
        $filme = Filme::find($sessao->filme_id);
        $sala = Sala::find($sessao->sala_id);
        $lugar = Lugar::find($bilhete->lugar_id);
        $recibo = Recibo::find($bilhete->recibo_id);


       $QRC=  QRcodeController::generateCode($bilhete->id);





        //envio para a view os dados que vão ser renderizados
        $html = view('mail.pdf', ['recibo' => $recibo, 'bilhete' => $bilhete,
            'fila' => $lugar->fila, 'posicao' => $lugar->posicao,
            'nome_sala' => $sala->nome, 'titulo' => $filme->titulo,
            'sessao'=>$sessao, 'qrCode' =>$QRC
        ])->render();

        //a biblioteca de pdf é uma merda. não renderiza as imagens então to a retornar ela direto
        return $html;


        //crio o pdf. nem adianta procurar pq não tem documentação
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->stream('bilhete.pdf', ['Attachment' => false]);
    }


}
