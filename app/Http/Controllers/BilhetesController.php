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
use Illuminate\Support\Facades\Auth;

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
        $sessao = Sessao::find($bilhete->sessao_id);

        $filme = Filme::find($sessao->filme_id);
        $sala = Sala::find($sessao->sala_id);
        $lugar = Lugar::find($bilhete->lugar_id);
        $recibo = Recibo::find($bilhete->recibo_id);


        return view('bilhetes.show', [
            'recibo' => $recibo, 'bilhete' => $bilhete,
            'fila' => $lugar->fila, 'posicao' => $lugar->posicao,
            'nome_sala' => $sala->nome, 'titulo' => $filme->titulo,
            'sessao' => $sessao
        ])->render();

        return view('bilhetes.show', compact('bilhete', 'sessao', 'filme', 'sala', 'lugar', 'recibo', 'fila', 'posicao', 'nome_sala'));
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


        $QRC =  QRcodeController::generateCode($bilhete->id);

        $user = Auth::user();
        $photoUrl = $user->fullPhotoUrl;

        //envio para a view os dados que vão ser renderizados
        $html = view('mail.pdf', [
            'recibo' => $recibo,
            'bilhete' => $bilhete,
            'fila' => $lugar->fila,
            'posicao' => $lugar->posicao,
            'nome_sala' => $sala->nome,
            'titulo' => $filme->titulo,
            'sessao' => $sessao,
            'qrCode' => $QRC,
            'photoUrl' => $photoUrl
        ])->render();


        //crio o pdf. nem adianta procurar pq não tem documentação
        $dompdf = new Dompdf(); // Instancia um novo objeto Dompdf
        $options = $dompdf->getOptions(); // Obtém as opções atuais do Dompdf

        $options->set('isHtml5ParserEnabled', true); // Habilita o parser HTML5
        $options->set('isRemoteEnabled', true); // Permite carregar recursos remotos (como imagens) no PDF

        $dompdf->setOptions($options); // Aplica as opções configuradas ao objeto Dompdf

        $dompdf->loadHtml($html); // Carrega o HTML que será utilizado para gerar o PDF

        $dompdf->setPaper('A4', 'portrait'); // Define o tamanho do papel do PDF como A4 no modo retrato (portrait)

        $dompdf->render(); // Renderiza o PDF com base no HTML fornecido

        return $dompdf->stream('bilhete.pdf', ['Attachment' => true]); // Retorna o PDF renderizado para ser visualizado no navegador com o nome 'bilhete.pdf' e opção de download ativada

    }
}
