@extends('layouts.app')
@section('title', 'Editar Categoria')
@section('page', 'Editar')
@section('content')
    <a href="{{ route('produtos.teste',$id) }}" type="button" class="mt-0 mb-4 btn btn-primary">
        <i class="fa fa-arrow-left" aria-hidden="true"></i> 
        Voltar
    </a>
    <h1>Editar Produto</h1>
    <form method="POST" action="{{ route('produtos.editar', [$produto, $id]) }}">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" required name="nome" id="nome" value="{{ $produto->nome }}" class="form-control">
                </div>
            </div>
            <div class="col-md-12" >
                <div class="form-group">
                    <label for="nome">Categoria</label>
                    <select class="form-select" size="1" name="categoria">
                        @foreach($nomeCategoria as $cat)
                            <option values="{{$cat->id}}">{{$cat ->nome}}</option>
                        @endforeach
                    </select>                    
                </div>
            </div>
            <div class="col-md-12" >
                <div class="form-group">
                    <label for="nome">Codigo de Barras</label>
                    <input type="text" name="codigoBarras" id="codigoBarras" class="form-control" value="{{ $produto->codigoBarras }}">
                </div>
            </div>
        </div>
        <div class="row">
            <button type="submit" class="mt-4 mb-4 btn btn-primary">Enviar</button>
        </div>
    </form>
@endsection


