
@extends('layouts.app')
@section('title', 'Criar Lista de Produtos')
@section('page', 'Criar')
@section('content')
    <form method="POST" action="{{ route('listaProduto.insert') }}">
        @csrf
        <div class="row">
            <div class="col-md-12" >
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" required name="nome" id="nome" class="form-control">
                </div>
            </div>
        </div>
        <button type="submit" class="mt-4 mb-4 btn btn-primary">Enviar</button>
    </form>
@endsection