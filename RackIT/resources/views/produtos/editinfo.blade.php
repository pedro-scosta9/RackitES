@extends('layouts.app')
@section('title', 'Editar Informações do Produto')
@section('page', 'Editar')
@section('content')
    <a href="{{ route('produtos.teste',$id) }}" type="button" class="mt-0 mb-4 btn btn-primary">
        <i class="fa fa-arrow-left" aria-hidden="true"></i> 
        Voltar
    </a>
    <h1>Editar Informações do Produto</h1>
    <form method="POST" action="{{ route('produtos.editarinfo', [$infoprod, $id]) }}">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-12" >
                <div class="form-group">
                    <label for="nome">Data de Compra</label>
                    <input type="date"  name="dataCompra" id="dataCompra" class="form-control" value="{{ $infoprod->dataCompra }}">
                </div>
            </div>
            <div class="col-md-12" >
                <div class="form-group">
                    <label for="nome">Data de Validade</label>
                    <input type="date" name="dataValidade" id="dataValidade" class="form-control" value="{{ $infoprod->dataValidade }}">
                </div>
            </div>
            <div class="col-md-12" >
                <div class="form-group">
                    <label for="nome">Preço de Compra</label>
                    <input type="decimal" name="precoCompra" id="precoCompra" class="form-control" value="{{ $infoprod->precoCompra }}">
                </div>
            </div>
            <div class="col-md-12" >
                <div class="form-group">
                    <label for="nome">Preço Normal</label>
                    <input type="decimal"  name="precoNormal" id="precoNormal" class="form-control" value="{{ $infoprod->precoNormal }}">
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


