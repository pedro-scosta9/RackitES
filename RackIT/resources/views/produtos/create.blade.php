@extends('layouts.app')
@section('title', 'Criar Categoria')
@section('page', 'Criar')
@section('content')
    <div class="col-12" >
        <a href="{{ route('produtos.index') }}" type="button" class="mt-0 mb-0 btn btn-primary">Introduzir novo produto</a>
    </div>
    <form method="POST" action="{{ route('produtos.insert') }}">
        @csrf
        <div class="row">
            <div class="col-md-12" >
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" required name="nome" id="nome" class="form-control">
                </div>
            </div>
            <div class="col-md-12" >
                <div class="form-group">
                    <label for="nome">Codigo Barras</label>
                    <input type="number" required name="codigoBarras" id="codigoBarras" class="form-control">
                </div>
            </div>
            <div class="col-md-12" >
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" required name="nome" id="nome" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <select class="form-select" size="1" name="lista">
                        @foreach($nomeProdutos as $prod)
                            <option values="{{$prod->id}}">{{$prod ->nome}}</option>
                        @endforeach
                    </select>
                </div>
                
            </div>
        </div>
        <button type="submit" class="mt-4 mb-4 btn btn-primary">Enviar</button>
    </form>
@endsection
