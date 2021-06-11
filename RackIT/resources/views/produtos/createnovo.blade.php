@extends('layouts.app')
@section('title', 'Criar Novo Produto')
@section('page', 'Criar')
@section('content')
    <a href="{{ route('produtos.teste',$id) }}" type="button" class="mt-0 mb-4 btn btn-primary">
        <i class="fa fa-arrow-left" aria-hidden="true"></i> 
        Voltar
    </a>
    <h1>Inserir novo produto</h1>
    <form method="POST" action="{{ route('produtos.insertInfoNovo', $id) }}">
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
                    <input type="text"  name="nomeproduto" id="nomeproduto" class="form-control">
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
                    <input type="text"  name="codigoBarras" id="codigoBarras" class="form-control">
                </div>
            </div>
            <div class="col-md-12" >
                <div class="form-group">
                    <label for="nome">Data de Compra</label>
                    <input type="date"  name="dataCompra" id="dataCompra" class="form-control">
                </div>
            </div>
            <div class="col-md-12" >
                <div class="form-group">
                    <label for="nome">Data de Validade</label>
                    <input type="date"  name="dataValidade" id="dataValidade" class="form-control">
                </div>
            </div>
            <div class="col-md-12" >
                <div class="form-group">
                    <label for="nome">Preço de Compra</label>
                    <input type="decimal" name="precoCompra" id="precoCompra" class="form-control">
                </div>
            </div>
            <div class="col-md-12" >
                <div class="form-group">
                    <label for="nome">Preço Normal</label>
                    <input type="decimal"  name="precoNormal" id="precoNormal" class="form-control">
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
    