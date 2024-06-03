<?php

namespace App\Http\Controllers;

use App\Models\Bilhete;
use App\Models\Filme;
use App\Models\Lugar;

use App\Models\Sessao;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function show(): View
    {
        $cart = session('cart', []);
        return view('cart.show', ['cart' => $cart]);

    }

    public function addToCart(Request $request, Lugar $lugar, Filme $v_filme, Sessao $v_sessao): RedirectResponse
    {
        try {

            #$client_id = $request->user()->id;todo se essas duas linhas não forem comentadas o utilizador não autenticado não consegue adicionar cenas ao carrinho
            #$totalBilhetes = DB::scalar('select count(*) from bilhetes where cliente_id = ? and sessao_id = ?', [$client_id, $lugar->id]);
            $totalBilhetes = 0; // todo ver se vale a pena deixa isso aqui com os colegas


            if ($totalBilhetes >= 1) {
                $alertType = 'warning';
                $url = route('sessoes.show', ['sesso' => $lugar]);
                $htmlMessage = "Não é possível adicionar o assento <a href='$url'>#{$lugar->id}</a>
                    <strong>\"{$lugar->nome}\"</strong> ao carrinho, pois já foi adicionado";
            } else {


                // We can access session with a "global" function
                $cart = session('cart', []);
                if (array_key_exists($lugar->id, $cart)) {
                    $alertType = 'warning';
                    $url = route('sessoes.show', ['sesso' => $lugar]);
                    $htmlMessage = "sesso <a href='$url'>#{$lugar->id}</a>
                         <strong>\"{$lugar->nome}\"</strong> já foi adicionado ao carrinho!";
                } else {









                    //incluir aqui os parms que quero no store
                    $cart[$lugar->id] = $lugar;
                    //$cart[$v_filme] = $v_filme;








                    // We can access session with a request function
                    $request->session()->put('cart', $cart);
                    $alertType = 'success';
                    $url = route('sessoes.show', ['sesso' => $lugar  ]);
                    $htmlMessage = "sesso <a href='$url'>#{$lugar->id}</a>
                        <strong>\"{$lugar->nome}\"</strong> foi adicionada ao carrinho!";
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
        $url = route('sessoes.show', ['sesso' => $lugar]);#TODO como a shared table dos lugares está toda esquizofrênica, eu estou mandando sesso, que é a variável cagada que não consigo mudar sem ter trabalho, mas com o lugar que quero remover


        $htmlMessage = "Lugar <a href='$url'>#{$lugar->id}</a> <strong>\"{$lugar->nome}\"</strong> foi removida do carrinho!";
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    public function store(Request $request)
    {
       return $request->all();

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
