@extends('layouts.app')
@section('title', 'Criar Categoria')
@section('page', 'Criar')
@section('content')

<a href="{{ route('produtos.index') }}" type="button" class="mt-0 mb-4 btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar
</a>
<div class="row">  
        <a href="{{ route('produtos.index') }}" type="button" class="mt-0 mb-0 btn btn-primary">Introduzir um novo produto</a>
</div>
<br>
    <form method="POST" action="{{ route('produtos.insertInfo') }}">
        @csrf
        <div class="row">
            <div class="col-md-12" >
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <select class="form-select" size="1" name="nome">
                        @foreach($nomeProdutos as $prod)
                            <option values="{{$prod->id}}">{{$prod ->nome}}</option>
                        @endforeach
                    </select>                    
                </div>
            </div>
            {{-- <div class="col-md-12" >
                <div class="form-group">
                    <label for="nome">Categoria</label>
                    <select class="form-select" size="1" name="categoria">
                        @foreach($nomeCategoria as $cat)
                            <option values="{{$cat->id}}">{{$cat ->nome}}</option>
                        @endforeach
                    </select>                    
                </div>
            </div> --}}
            
            {{-- <div class="col-md-12" >
                <div class="form-group">
                    <label for="nome">Codigo Barras</label>
                    <input type="number" name="codigoBarras" id="codigoBarras" class="form-control">
                </div>
            </div> --}}
            <div class="col-md-12" >
                <div class="form-group">
                    <label for="nome">Data de Compra</label>
                    <input type="date"  name="dataCompra" id="nome" class="form-control">
                </div>
            </div>
            <div class="col-md-12" >
                <div class="form-group">
                    <label for="nome">Data de Validade</label>
                    <input type="date"  name="dataValidade" id="nome" class="form-control">
                </div>
            </div>
            <div class="col-md-12" >
                <div class="form-group">
                    <label for="nome">Preço de Compra</label>
                    <input type="decimal" name="precoCompra" id="nome" class="form-control">
                </div>
            </div>
            <div class="col-md-12" >
                <div class="form-group">
                    <label for="nome">Preço Normal</label>
                    <input type="decimal"  name="precoNormal" id="nome" class="form-control">
                </div>
            </div>
            
            <div class="col-md-12" >
                <div class="form-group">
                    <label for="nome">Armazenado</label>
                    <select class="form-select" size="1" name="armazem">
                        @foreach($nomeArmazem as $arm)
                            <option values="{{$arm->id}}">{{$arm ->nome}}</option>
                        @endforeach
                    </select>                    
                </div>
            </div>
        </div>
        <div class="row">
            <button type="submit" class="mt-4 mb-4 btn btn-primary">Enviar</button>
        </div>
        
    </form>
    @endsection
    