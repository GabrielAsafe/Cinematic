<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recibo;
use App\Models\Bilhete;
use App\Models\Filme;
use App\Models\Genero;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;

class EstatisticaController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Filme::class, 'filme');
    }

    public function index(Request $request)
    {
        $selecao = $request->input('selecao', 'porValor');

        // Estatísticas por valor
        $totalVendas = Recibo::sum('preco_total_com_iva');
        $mediaVendas = Recibo::avg('preco_total_com_iva');
        $maxVendas = Recibo::max('preco_total_com_iva');
        $minVendas = Recibo::min('preco_total_com_iva');

        // Estatísticas por quantidade
        $totalBilhetes = Bilhete::count();
        $mediaBilhetes = Bilhete::avg('preco_sem_iva');
        $maxBilhetes = Bilhete::max('preco_sem_iva');
        $minBilhetes = Bilhete::min('preco_sem_iva');

        // Estatísticas por mês
        $vendasPorMes = Recibo::select(
            DB::raw('YEAR(data) as ano'),
            DB::raw('MONTH(data) as mes'),
            DB::raw('SUM(preco_total_com_iva) as total')
        )->groupBy('ano', 'mes')->paginate(10);

        // Estatísticas por ano
        $vendasPorAno = Recibo::select(
            Recibo::raw('YEAR(data) as ano'),
            Recibo::raw('SUM(preco_total_com_iva) as total')
        )->groupBy('ano')->paginate(10);

        // Estatísticas por filme
        $vendasPorFilme = Recibo::select(
            'filmes.titulo as filme',
            Recibo::raw('SUM(recibos.preco_total_com_iva) as total_vendas'),
            Recibo::raw('AVG(recibos.preco_total_com_iva) as media_vendas'),
            Recibo::raw('MAX(recibos.preco_total_com_iva) as max_venda'),
            Recibo::raw('MIN(recibos.preco_total_com_iva) as min_venda')
        )
            ->join('bilhetes', 'recibos.id', '=', 'bilhetes.recibo_id')
            ->join('sessoes', 'bilhetes.sessao_id', '=', 'sessoes.id')
            ->join('filmes', 'sessoes.filme_id', '=', 'filmes.id')
            ->groupBy('filmes.titulo')
            ->paginate(10);

        // Estatísticas por categoria de filme
        $vendasPorCategoria = Recibo::select(
            'generos.nome as genero',
            Recibo::raw('SUM(recibos.preco_total_com_iva) as total_vendas'),
            Recibo::raw('AVG(recibos.preco_total_com_iva) as media_vendas'),
            Recibo::raw('MAX(recibos.preco_total_com_iva) as max_venda'),
            Recibo::raw('MIN(recibos.preco_total_com_iva) as min_venda')
        )
            ->join('bilhetes', 'recibos.id', '=', 'bilhetes.recibo_id')
            ->join('sessoes', 'bilhetes.sessao_id', '=', 'sessoes.id')
            ->join('filmes', 'sessoes.filme_id', '=', 'filmes.id')
            ->join('generos', 'filmes.genero_code', '=', 'generos.code')
            ->groupBy('generos.nome')
            ->paginate(10);

        // Estatísticas por cliente
        $vendasPorCliente = Recibo::select(
            'users.name as cliente',
            Recibo::raw('COUNT(recibos.id) as total_compras'),
            Recibo::raw('SUM(recibos.preco_total_com_iva) as total_gasto'),
            Recibo::raw('AVG(recibos.preco_total_com_iva) as media_gasto'),
            Recibo::raw('MAX(recibos.preco_total_com_iva) as maior_compra'),
            Recibo::raw('MIN(recibos.preco_total_com_iva) as menor_compra')
        )
            ->join('bilhetes', 'recibos.id', '=', 'bilhetes.recibo_id')
            ->join('clientes', 'bilhetes.cliente_id', '=', 'clientes.id')
            ->join('users', 'clientes.id', '=', 'users.id')
            ->groupBy('users.name')
            ->paginate(10);

        return view('estatisticas.index', compact(
            'totalVendas',
            'mediaVendas',
            'maxVendas',
            'minVendas',
            'totalBilhetes',
            'mediaBilhetes',
            'maxBilhetes',
            'minBilhetes',
            'vendasPorMes',
            'vendasPorAno',
            'vendasPorFilme',
            'vendasPorCategoria',
            'vendasPorCliente',
            'selecao'
        ));
    }
}
