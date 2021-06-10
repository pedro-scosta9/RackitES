@extends('layouts.app')
@section('title', 'Lista de armazens')
@section('page', 'armazens')
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
    <div class="col-2" ><a href="{{ route('armazens.index') }}" type="button" class="mt-0 mb-0 btn btn-primary">Atualizar Lista</a></div>
</div>
{{-- {{$teste}} --}}
<br>
<a href="{{ route('armazens.inserir') }}" type="button" class="mt-4 mb-4 btn btn-primary">Inserir armazens</a>

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
                        @foreach ($armazens as $cat)
                            <tr>
                                <td>{{ $cat->id }}</td>
                                <td>{{ $cat->nome }}</td>
                                <td><a href="{{ route('armazens.edit',$cat) }}" type="button" class="btn btn-success font-weight-bold w-100"><i class="fa fa-edit" aria-hidden="true"> </i>  Editar</a></td>
                                <td><a href="{{ route('armazens.delete',$cat) }}" type="button" class="btn btn-danger font-weight-bold w-100"><i class="fa fa-trash" aria-hidden="true"> </i>  Apagar</a></td>


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
