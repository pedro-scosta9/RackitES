@extends('layouts.app')
@section('title', 'Editar lista de produtos ')
@section('page', 'Editar')
@section('content')
    <form method="POST" action="{{ route('listaProduto.editar', $listaProduto) }}">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" required name="nome" id="nome" value="{{ $listaProduto->nome }}" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <button type="submit" class="mt-4 mb-4 btn btn-primary">Enviar</button>
        </div>
    </form>
@endsection