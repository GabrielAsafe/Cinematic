@extends('template.layout')

@section('titulo', 'Estatísticas de Vendas')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Estatísticas</li>
        <li class="breadcrumb-item active">Estatísticas de Vendas</li>
    </ol>
@endsection

@section('main')
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <form method="GET" action="{{ route('estatisticas.index') }}">
                    <div class="form-group">
                        <label for="estatisticasDropdown">Selecione a Estatística</label>
                        <select class="form-control" id="estatisticasDropdown" name="selecao" onchange="this.form.submit()">
                            <option value="porValor" {{ $selecao == 'porValor' ? 'selected' : '' }}>Por Valor</option>
                            <option value="porQuantidade" {{ $selecao == 'porQuantidade' ? 'selected' : '' }}>Por Quantidade</option>
                            <option value="vendasPorMes" {{ $selecao == 'vendasPorMes' ? 'selected' : '' }}>Vendas por Mês</option>
                            <option value="vendasPorAno" {{ $selecao == 'vendasPorAno' ? 'selected' : '' }}>Vendas por Ano</option>
                            <option value="vendasPorFilme" {{ $selecao == 'vendasPorFilme' ? 'selected' : '' }}>Vendas por Filme</option>
                            <option value="vendasPorCategoria" {{ $selecao == 'vendasPorCategoria' ? 'selected' : '' }}>Vendas por Categoria de Filme</option>
                            <option value="vendasPorCliente" {{ $selecao == 'vendasPorCliente' ? 'selected' : '' }}>Vendas por Cliente</option>
                        </select>
                    </div>
                </form>
                <br>
                @if($selecao == 'porValor')
                    <h4>Por Valor</h4>
                    <table class="table">
                        <thead class="table-dark">
                        <tr>
                            <th>Total de Vendas</th>
                            <th>Média de Vendas</th>
                            <th>Maior Venda</th>
                            <th>Menor Venda</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ number_format($totalVendas, 2, ',', '.') }}€</td>
                            <td>{{ number_format($mediaVendas, 2, ',', '.') }}€</td>
                            <td>{{ number_format($maxVendas, 2, ',', '.') }}€</td>
                            <td>{{ number_format($minVendas, 2, ',', '.') }}€</td>
                        </tr>
                        </tbody>
                    </table>

                @elseif($selecao == 'porQuantidade')
                    <h4>Por Quantidade</h4>
                    <table class="table">
                        <thead class="table-dark">
                        <tr>
                            <th>Total de Bilhetes Vendidos</th>
                            <th>Média de Preço dos Bilhetes</th>
                            <th>Preço mais Alto de Bilhete</th>
                            <th>Preço mais Baixo de Bilhete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $totalBilhetes }}</td>
                            <td>{{ number_format($mediaBilhetes, 2, ',', '.') }}€</td>
                            <td>{{ number_format($maxBilhetes, 2, ',', '.') }}€</td>
                            <td>{{ number_format($minBilhetes, 2, ',', '.') }}€</td>
                        </tr>
                        </tbody>
                    </table>

                @elseif($selecao == 'vendasPorMes')
                    <h4>Vendas por Mês</h4>
                    <table class="table">
                        <thead class="table-dark">
                        <tr>
                            <th>Ano</th>
                            <th>Mês</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($vendasPorMes as $venda)
                            <tr>
                                <td>{{ $venda->ano }}</td>
                                <td>{{ $venda->mes }}</td>
                                <td>{{ number_format($venda->total, 2, ',', '.') }}€</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $vendasPorMes->appends(['selecao' => $selecao])->links() }} <!-- Adiciona os links de navegação -->

                @elseif($selecao == 'vendasPorAno')
                    <h4>Vendas por Ano</h4>
                    <table class="table">
                        <thead class="table-dark">
                        <tr>
                            <th>Ano</th>
                            <th>Total de Vendas</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($vendasPorAno as $venda)
                            <tr>
                                <td>{{ $venda->ano }}</td>
                                <td>{{ number_format($venda->total, 2, ',', '.') }}€</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $vendasPorAno->appends(['selecao' => $selecao])->links() }} <!-- Adiciona os links de navegação -->

                @elseif($selecao == 'vendasPorFilme')
                    <h4>Vendas por Filme</h4>
                    <table class="table">
                        <thead class="table-dark">
                        <tr>
                            <th>Filme</th>
                            <th>Total de Vendas</th>
                            <th>Média de Vendas</th>
                            <th>Maior Venda</th>
                            <th>Menor Venda</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($vendasPorFilme as $venda)
                            <tr>
                                <td>{{ $venda->filme }}</td>
                                <td>{{ number_format($venda->total_vendas, 2, ',', '.') }}€</td>
                                <td>{{ number_format($venda->media_vendas, 2, ',', '.') }}€</td>
                                <td>{{ number_format($venda->max_venda, 2, ',', '.') }}€</td>
                                <td>{{ number_format($venda->min_venda, 2, ',', '.') }}€</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $vendasPorFilme->appends(['selecao' => $selecao])->links() }} <!-- Adiciona os links de navegação -->

                @elseif($selecao == 'vendasPorCategoria')
                    <h4>Vendas por Categoria de Filme</h4>
                    <table class="table">
                        <thead class="table-dark">
                        <tr>
                            <th>Categoria</th>
                            <th>Total de Vendas</th>
                            <th>Média de Vendas</th>
                            <th>Maior Venda</th>
                            <th>Menor Venda</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($vendasPorCategoria as $venda)
                            <tr>
                                <td>{{ $venda->genero }}</td>
                                <td>{{ number_format($venda->total_vendas, 2, ',', '.') }}€</td>
                                <td>{{ number_format($venda->media_vendas, 2, ',', '.') }}€</td>
                                <td>{{ number_format($venda->max_venda, 2, ',', '.') }}€</td>
                                <td>{{ number_format($venda->min_venda, 2, ',', '.') }}€</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $vendasPorCategoria->appends(['selecao' => $selecao])->links() }} <!-- Adiciona os links de navegação -->

                @elseif($selecao == 'vendasPorCliente')
                    <h4>Vendas por Cliente</h4>
                    <table class="table">
                        <thead class="table-dark">
                        <tr>
                            <th>Cliente</th>
                            <th>Total de Compras</th>
                            <th>Total Gasto</th>
                            <th>Média Gasto</th>
                            <th>Maior Compra</th>
                            <th>Menor Compra</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($vendasPorCliente as $venda)
                            <tr>
                                <td>{{ $venda->cliente }}</td>
                                <td>{{ $venda->total_compras }}</td>
                                <td>{{ number_format($venda->total_gasto, 2, ',', '.') }}€</td>
                                <td>{{ number_format($venda->media_gasto, 2, ',', '.') }}€</td>
                                <td>{{ number_format($venda->maior_compra, 2, ',', '.') }}€</td>
                                <td>{{ number_format($venda->menor_compra, 2, ',', '.') }}€</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $vendasPorCliente->appends(['selecao' => $selecao])->links() }} <!-- Adiciona os links de navegação -->
                @endif
            </div>
        </div>
    </div>

@endsection
