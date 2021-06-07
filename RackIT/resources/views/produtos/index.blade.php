@extends('layouts.app')
@section('title', 'Lista de Categorias')
@section('page', 'Categorias')
@section('content')

    {{-- <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head> --}}
    <a href="{{ route('produtos.inserir') }}" type="button" class="mt-4 mb-4 btn btn-primary">Inserir Produtos</a>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-condensed table-striped" id="dataTable" width="100%">
                    <thead>
                        <tr>
                            <th>Codigo Barras</th>
                            <th>Nome</th>
                            <th>Quantidade</th>
                            <th>Categoria</th>

                        </tr>
                    </thead>
                    <tbody>
                        {{-- PARA CADA USER VER LISTAS
                        PARA CADA PRODUTO VER SE A LISTA PRODUTOS COINCIDE --}}

                        {{-- Para cada produto --}}
                        @foreach ($produto as $prod)
                            {{-- Usado para contar quantidade --}}
                            @php($val = 0)
                                {{-- Para cada infoproduto com id = idProduto, adiciono1 quantidade --}}
                                @foreach ($infoproduto as $infoprod)
                                    @if ($prod->id == $infoprod->idProduto)
                                        @php($val += 1)
                                        @endif
                                    @endforeach
                                    {{-- Para cada produto crio uma row --}}
                                    <tr data-toggle="collapse" data-target="#A{{ $prod->id }}">
                                        <td>{{ $prod->id }}</td>
                                        <td>{{ $prod->nome }}</td>
                                        {{-- <td>{{ $infoprod->idProduto }}</td> --}}
                                        <td>{{ $val }}</td>
                                        {{-- Verifico a categoria --}}
                                        @foreach ($categoria as $cat)
                                            @if ($cat->id == $prod->idCategoria)
                                                <td>{{ $cat->nome }}</td>


                                            @endif
                                        @endforeach
                                        <td><i class="fa fa-plus" aria-hidden="true">Ver mais</i></td>

                                    </tr>


                                    {{-- Para cada produto, crio uma nova tabela com as informações de cada produto --}}
                                    <td colspan="5" id="A{{ $prod->id }}" class="collapse table table-bordered table-condensed">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Quantidade</th>

                                                    <th>Codigo Barras</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr id="A{{ $prod->id }}" class="collapse">
                                                    @php($aux = 0)
                                                        @foreach ($infoproduto as $infoprod)
                                                            @php($dataValidadeI = $infoprod->dataValidade)
                                                                {{-- Se codigo barras igual --}}
                                                                @if ($prod->id == $infoprod->idProduto)

                                                                    @if ($infoprod->dataValidade = $dataValidadeI)
                                                                        @php($aux += 1)

                                                            <tr id="A{{ $prod->id }}" class="collapse">
                                                                <td>{{ $aux }}</td>

                                                                <td>{{ $prod->nome }}</td>

                                                                <td>{{ $infoprod->idProduto }}</td>
                                                                <td>{{ $infoprod->dataValidade }}</td>
                                                                <td>{{ $infoprod->count() }}</td>
                                                                <td></td>

                                                            </tr>

                                            @endif
                                            @endif

                                            @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>










                                @endforeach
                                </tbody>
                                </table>


                            </div>
                        </div>
                        </div>
                    @endsection