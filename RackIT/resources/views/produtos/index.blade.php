@extends('layouts.app')
@section('title', 'Lista de Categorias')
@section('page', 'Categorias')
@section('content')
<div class="row">
    <div class="col-10">
    <form method="POST" action="{{ route('produtos.index') }}">
        @csrf

        <select class="form-select" size="1" name="SelectListaProdutos">
            @foreach($nomedaslistas as $listas)
            <option values="{{$listas->id}}">{{$listas ->nome}}</option>

            @endforeach
            {{-- {!! Form::select('size', array($nomedaslistas->id => $nomedaslistas->nome)) !!} --}}
        </select>
    </form>
</div>

    <div class="col-2" ><a href="{{ route('produtos.index') }}" type="button" class="mt-0 mb-0 btn btn-primary">Atualizar Lista</a></div>
</div>

    {{-- <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head> --}}
    <div class="row">
        <div class="col-3 pr-0">
            <a href="{{ route('produtos.inserir') }}" type="button" class="mt-4 mb-4 btn btn-primary">Adicionar Novo Produto</a>
        </div>
        <div class="col-2 pl-0">
            <a href="{{ route('produtos.inserir') }}" type="button" class="mt-4 mb-4 btn btn-primary">Adicionar Produto</a>
        </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-condensed table-striped" id="dataTable" width="100%">
                    <thead>
                        <tr>
                            <th>Codigo Barras</th>
                            <th>Nome</th>
                            <th>Quantidade</th>
                            <th>Informações do Produto</th>
                            <th>Adicionar produto</th>
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
                                    @if ($prod->id == $infoprod->produtosID)
                                        @php($val += 1)
                                        @endif
                                    @endforeach
                                    {{-- Para cada produto crio uma row --}}
                                    <tr data-toggle="collapse" data-target="#A{{ $prod->id }}">
                                        <td>{{ $prod->codigoBarras }}</td>
                                        <td>{{ $prod->nome }}</td>
                                        {{-- <td>{{ $infoprod->idProduto }}</td> --}}
                                        <td>{{ $val }}</td>
                                        {{-- Verifico a categoria --}}
                                        </td>
                                        <td> @foreach ($produtosCategorias as $cat)
                                        @if ($cat->produtos_id == $prod->idCategoria)
                                            {{ $cat->id }}
                                        
                                        </td>


                                        @endif
                                    @endforeach</td>
                                    <td><a href="{{ route('produtos.inserir') }}" type="button" class="btn btn-primary font-weight-bold w-100"><i class="fa fa-plus" aria-hidden="true"> </i>  Adicionar {{$prod->nome}}</a>

                                    </tr>


                                    {{-- Para cada produto, crio uma nova tabela com as informações de cada produto --}}
                                    <td colspan="5" id="A{{ $prod->id }}" class="collapse table table-bordered table-condensed">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Data de Compra</th>
                                                    <th>Data de Validade</th>
                                                    <th>Preço de Compra</th>
                                                    <th>Preço Normal</th>
                                                    <th>Armazenado</th>
                                                    <th>Editar</th>
                                                    <th>Apagar</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr id="A{{ $prod->id }}" class="collapse">
                                                    @php($aux = 0)
                                                        @foreach ($infoproduto as $infoprod)
                                                            @if ($prod->id == $infoprod->produtosID)
                                                                @php($dataValidadeI = $infoprod->dataValidade)
                                                                {{-- Se codigo barras igual --}}

                                                                    {{-- @if ($infoprod->dataValidade = $dataValidadeI)
                                                                        @php($aux += 1) --}}

                                                                        {{-- @endif  --}}
                                                                        @php($aux+=1)
                                                                        <tr id="A{{ $prod->id }}" class="collapse">
                                                                            <td>{{ $infoprod->dataCompra }}</td>
                                                                            
                                                                            <td>{{ $infoprod->dataValidade }}</td>
                                                                            
                                                                            <td>{{ $infoprod->precoCompra }}</td>
                                                                            <td>{{ $infoprod->precoNormal }}</td>
                                                                            <td>
                                                                                @foreach ($armazens as $a)
                                                                                    @if ($infoprod->armazemID == $a->id) 
                                                                                        {{ $a->nome }}
                                                                                    @endif
                                                                                @endforeach
                                                                            </td>
                                                                            <td>
                                                                                <a href="{{route('categoria.edit',$infoprod)}}"><i class="fas fa-edit text-info mr-1" ></i></a>  
                                                                            </td>
                                                                            <td>  
                                                                                <a href="{{route('categoria.delete',$infoprod)}}"><i class="fas fa-trash-alt text-info mr-1"></i></a>
                                                                            </td>
                                                
                                                                          
                                                                            
                                                                        </tr>
                                                                        
                                                                        {{-- @endif --}}
                                                                    @endif
                                                                @endforeach
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                </div>










                                @endforeach
                                </tbody>
                                </table>


                            </div>
                        </div>
                        </div>
                    @endsection
