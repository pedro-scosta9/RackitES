@extends('layouts.app')
@section('title', 'Criar Categoria')
@section('page', 'Criar')
@section('content')
    <a href="{{ route('categoria.teste',$id) }}" type="button" class="mt-0 mb-4 btn btn-primary">
        <i class="fa fa-arrow-left" aria-hidden="true"></i> 
        Voltar
    </a>
    <h1>Inserir nova categoria</h1>
    <form method="POST" action="{{ route('categoria.insert',$id) }}">
        @csrf
        <div class="row">
            <div class="col-md-12" >
                <div class="form-group">
                    <label for="nome">Lista Produtos</label>
                    <select class="form-select" size="1" name="lista">
                        @foreach($nomedaslistas as $listas)
                            <option values="{{$listas->id}}" selected>{{$listas ->nome}}</option>
                        @endforeach
                    </select>                    
                </div>
            </div>
            <div class="col-md-12" >
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" required name="nome" id="nome" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <button type="submit" class="mt-4 mb-4 btn btn-primary">Enviar</button>
        </div>
    </form>
@endsection
