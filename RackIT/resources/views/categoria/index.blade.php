@extends('layouts.app')
@section('title', 'Lista de Categorias')
@section('page', 'Categorias')
@section('content')

<div class="row">
    <div class="col-10">
        <select class="form-select" size="1" name="SelectListaProdutos">
            @foreach($nomedaslistas as $listas)
            <option values="{{$listas->id}}">{{$listas ->nome}}</option> 
            
            @endforeach
            {{-- {!! Form::select('size', array($nomedaslistas->id => $nomedaslistas->nome)) !!} --}}
        </select>
    </div>
    <div class="col-2" ><a href="{{ route('categoria.index') }}" type="button" class="mt-0 mb-0 btn btn-primary">Atualizar Lista</a></div>
</div>
{{-- {{$teste}} --}}
<br>
<a href="{{ route('categoria.inserir') }}" type="button" class="mt-4 mb-4 btn btn-primary">Inserir Categoria</a>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Editar</th>
                            <th>Apagar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categoria as $cat)
                            <tr>
                                <td>{{ $cat->id }}</td>
                                <td>{{ $cat->nome }}</td>
                                <td><a href="{{route('categoria.edit',$cat)}}"><i class="fas fa-edit text-info mr-1" ></a></td>
                                <td><a href="{{route('categoria.delete',$cat)}}"><i class="fas fa-trash-alt text-info mr-1"></a></td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
{{-- @foreach ($produtos as $produto)
    <hr>
        <p>Produto: {{$produto->id}} - {{$produto->nome}} <br>
        Descriçao: {{$produto->descricao}} <br>
        Quantidade: {{$produto->quantidade}}x<br>
        Preço: {{$produto->preco}}€<br>
        Criado: {{$produto->created_at}}<br>
        Editado: {{$produto->updated_at}}
        </p>
    @endforeach
    <hr>
@endsection --}}
