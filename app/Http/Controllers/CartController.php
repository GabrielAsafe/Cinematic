<?php

namespace App\Http\Controllers;

use App\Mail\MyTestEmail;
use App\Models\Bilhete;
use App\Models\Cliente;
use App\Models\Configuracao;
use App\Models\Lugar;
use App\Models\Recibo;
use App\Models\Sala;
use App\Services\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public $timestamps = true;


    public function show(): View
    {
        $cart = session('cart', []);
        return view('cart.show', ['cart' => $cart]);
    }

    public function addToCart(Request $request, Lugar $lugar): RedirectResponse
    {
        try {

            #$client_id = $request->user()->id;todo se essas duas linhas não forem comentadas o utilizador não autenticado não consegue adicionar cenas ao carrinho
            #$totalBilhetes = DB::scalar('select count(*) from bilhetes where cliente_id = ? and sessao_id = ?', [$client_id, $lugar->id]);
            $totalBilhetes = 0; // todo ver se vale a pena deixa isso aqui com os colegas


            if ($totalBilhetes >= 1) {
                $alertType = 'warning';
                $htmlMessage = "Não é possível adicionar o assento
                    <strong>\"{$lugar->fila}{$lugar->posicao}\"</strong> ao carrinho, pois já foi adicionado";
            } else {


                // We can access session with a "global" function
                $cart = session('cart', []);
                if (array_key_exists($lugar->id, $cart)) {
                    $alertType = 'warning';
                    $htmlMessage = "Lugar
                         <strong>\"{$lugar->fila}{$lugar->posicao}\"</strong> já foi adicionado ao carrinho!";
                } else {
                    //incluir aqui os parms que quero no store
                    $cart[$lugar->id] = $lugar;
                    // We can access session with a request function
                    $request->session()->put('cart', $cart);
                    $alertType = 'success';
                    $htmlMessage = "Lugar
                        <strong>\"{$lugar->fila}{$lugar->posicao}\"</strong> foi adicionada ao carrinho!";
                }
            }
        } catch (\Exception $error) {

            // Capturar a mensagem de erro
            $errorMessage = $error->getMessage();

            // Capturar o stack trace
            $errorTrace = $error->getTraceAsString();

            // Exibir uma mensagem amigável para o usuário
            $htmlMessage = "Não é possível associar assento <strong>\"{$lugar->id}\"</strong> ao carrinho, porque ocorreu um erro!";
            $alertType = 'danger';

            // Adicionar detalhes do erro para o frontend (apenas em ambiente de desenvolvimento)
            if (ini_get('display_errors')) {
                $htmlMessage .= "<br><strong>Erro:</strong> $errorMessage<br><pre>$errorTrace</pre>";
            }

            // Exibir a mensagem no frontend
            echo "<div class='alert alert-$alertType'>$htmlMessage</div>";
        }
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }


    public function removeFromCart(Request $request, Lugar $lugar): RedirectResponse
    {
        $cart = session('cart', []);
        if (array_key_exists($lugar->id, $cart)) {
            unset($cart[$lugar->id]);
        }
        $request->session()->put('cart', $cart);
        $url = route('sessoes.show', ['sesso' => $lugar]); #TODO como a shared table dos lugares está toda esquizofrênica, eu estou mandando sesso, que é a variável cagada que não consigo mudar sem ter trabalho, mas com o lugar que quero remover


        $htmlMessage = "Lugar <strong>\"{$lugar->fila}{$lugar->posicao}\"</strong> foi removida do carrinho!";
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    public function store(Request $request)
    {
        $dadosPagamento = (object) $request->session()->get('pagamento');
        $dadosSessao = (object) $request->session()->get('v_sessao');
        $lugar =  $dadosPagamento->Bilhetes;

        $dados = [
            'dadosPagamento' => $dadosPagamento,
            'dadosSessao' => $dadosSessao,
            'lugar' => $lugar
        ];

        //return $dados;


        if ($dadosPagamento->TipoPagamento == 'PAYPAL') {
            $valor = Payment::payWithPaypal($dadosPagamento->ReferênciaPagamento);
        }
        if ($dadosPagamento->TipoPagamento == 'MBWAY') {
            $valor =  Payment::payWithMBway($dadosPagamento->ReferênciaPagamento);
        }
        if ($dadosPagamento->TipoPagamento == 'VISA') {
            $valor =  Payment::payWithVisa($dadosPagamento->ReferênciaPagamento, 101);
        }
        if ($dadosPagamento->TipoPagamento == 'N/A') {
            $valor =  0;
        }

        if ($valor == 1) {
            //cria recibo
            $recibo = new Recibo();
            $recibo->cliente_id = Auth::id();
            $recibo->data = date('Y-m-d H:i:s', strtotime($dadosPagamento->DataCompra)); // Converter a data para o formato adequado
            $recibo->preco_total_sem_iva = $dadosPagamento->TotalsIVA;
            $recibo->iva = $dadosPagamento->IVA;
            $recibo->preco_total_com_iva = $dadosPagamento->TotalIVA;
            $recibo->nif = $dadosPagamento->NIF;
            $recibo->nome_cliente = $dadosPagamento->NomeCliente;
            $recibo->tipo_pagamento = $dadosPagamento->TipoPagamento;
            $recibo->ref_pagamento = $dadosPagamento->ReferênciaPagamento;
            $recibo->save();
            //pega o id do recibo gerado
            $reciboId = $recibo->id;


            //cria bilhete
            $bilhetes = array();
            array_push($bilhetes, $recibo);
            foreach ($lugar as $x) {
                $pc = (object) $x; //preciso fazer um cast de {} para objeto
                $bilhete = new Bilhete();
                $bilhete->recibo_id = $reciboId;
                $bilhete->cliente_id = Auth::id();
                $bilhete->sessao_id = $dadosSessao->id;
                $bilhete->lugar_id = $pc->ID;
                $bilhete->preco_sem_iva = $dadosPagamento->TotalsIVA;
                $bilhete->estado = 'não usado';
                array_push($bilhetes, $bilhete);
                $bilhete->save();
            }

            //esvazia o cart
            $request->session()->forget('cart');

            //envia recibo para o cliente
            Mail::to(Auth::user()->email)->send(new MyTestEmail($bilhetes));

            return redirect()->route('bilhetes.index');
        } else {
            $htmlMessage = "Não foi possível terminar a compra. Verifique o método de pagamento";
            return redirect()->route('cart.show')
                ->with('alert-msg', $htmlMessage)
                ->with('alert-type', 'success');
        }
    }




    public function validatePayment(Request $request)
    {



        try {
            $userType = Auth::user()->tipo ?? 'O';

            if ($userType == 'O') {
                $alertType = 'warning';
                $htmlMessage = "O utilizador não está autenticado e não poderá prosseguir com a compra";
            } else {
                $valor = $request->session()->get("v_sessao");
                $salaNome = Sala::find($valor->sala_id)->nome;
                $dadosCliente = Cliente::find(Auth::id());
                $config = Configuracao::find(1);
                $c_name = Auth::user()->name;



                $totalSemIVA = $config->preco_bilhete_sem_iva * sizeof($request->session()->all()['cart']); //TODO multiplicar pela quantidade de lugares
                $percentagemIVA = $config->percentagem_iva;
                $totalComIVA = ($percentagemIVA / 100) * $totalSemIVA + $totalSemIVA;

                $sessionData = [
                    'DataCompra' => now()->format('d/m/Y H:i:s'),
                    'NomeCliente' =>  $c_name,
                    'NIF' => $dadosCliente->nif ?? 'N/A',
                    'ReferênciaPagamento' => $dadosCliente->ref_pagamento ?? 'null',
                    'TipoPagamento' => $dadosCliente->tipo_pagamento ?? 'N/A',
                    'TotalsIVA' => $totalSemIVA,
                    'IVA' => $percentagemIVA,
                    'TotalIVA' => $totalComIVA,
                ];

                foreach (session('cart') as $lugar) {
                    $sessionData['Bilhetes'][] = [
                        'ID' => $lugar['id'],
                        'Filme' => session('v_filme')->titulo,
                        'Sala' => $salaNome,
                        'Data' => session('v_sessao')->data,
                        'Hora' => session('v_sessao')->horario_inicio,
                        'Lugar' => 'Fila ' . $lugar['fila'] . ', Posição ' . $lugar['posicao'],
                        'Preço' => ($percentagemIVA / 100) * $config->preco_bilhete_sem_iva + $config->preco_bilhete_sem_iva,
                        'Cliente' => $c_name,
                    ];
                }

                // Armazenando os dados na sessão
                $request->session()->put('pagamento', $sessionData);
                return view('cart.validatePayment', ['sessionData' => $sessionData]);
            }
        } catch (\Exception $error) {
            $htmlMessage = "Não foi possível prosseguir para o pagamento porque ocorreu um erro!";
            $alertType = 'danger';
        }
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->session()->forget('cart');
        $htmlMessage = "Carrinho está limpo!";
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }
}
