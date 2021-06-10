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
        <div class="col-6">
            <a href="{{ route('produtos.inserirnovo') }}" type="button" class="mt-4 mb-4 btn btn-success w-100">Adicionar Novo Produto</a>
        </div>
        <div class="col-6">
            <a href="{{ route('produtos.inserir')}}" type="button" class="mt-4 mb-4 btn btn-primary w-100">Adicionar Produto Existente</a>
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
                            <th>Categorias</th>
                            <th>Adicionar Produto</th>
                            <th>Editar Produto</th>
                            <th>Apagar Produto</th>

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
                                        <td>{{$prod->categoria}}</td>



                                    <td><a href="{{ route('produtos.inserir') }}" type="button" class="btn btn-primary font-weight-bold w-100"><i class="fa fa-plus" aria-hidden="true"> </i>  Adicionar</a></td>
                                    <td><a href="{{ route('produtos.edit',$prod->id) }}" type="button" class="btn btn-success font-weight-bold w-100"><i class="fa fa-edit" aria-hidden="true"> </i>  Editar</a></td>
                                    <td><a href="{{ route('produtos.delete',$prod->id) }}" type="button" class="btn btn-danger font-weight-bold w-100"><i class="fa fa-trash" aria-hidden="true"> </i>  Apagar</a></td>
                                    </tr>


                                    {{-- Para cada produto, crio uma nova tabela com as informações de cada produto --}}
                                    <td colspan="7" id="A{{ $prod->id }}" class="collapse table table-bordered table-condensed">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Data de Compra</th>
                                                    <th>Data de Validade</th>
                                                    <th>Preço de Compra</th>
                                                    <th>Preço Normal</th>
                                                    <th>Armazenado</th>
                                                    <th></th>
                                                    <th></th>

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
                                                                            <td><a href="{{ route('produtos.editinfo',$infoprod->id) }}" type="button" class="text-success font-weight-bold w-100"><i class="fa fa-edit" aria-hidden="true"> </i>  Editar</a></td>
                                                                            <td><a href="{{ route('produtos.deleteinfo',$infoprod->id) }}" type="button" class="text-danger font-weight-bold w-100"><i class="fa fa-trash" aria-hidden="true"> </i>  Apagar</a></td>
                                                
                                                                          
                                                                            
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
