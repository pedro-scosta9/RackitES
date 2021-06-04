@extends('layouts.app')
@section('title', 'Editar Categoria')
@section('page', 'Editar')
@section('content')

    <form method="POST" action="{{ route('produtos.editar', $categoria) }}">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" required name="nome" id="nome" value="{{ $categoria->nome }}" class="form-control">
                </div>
            </div>
        </div>
        <button type="submit" class="mt-4 mb-4 btn btn-primary">Enviar</button>
    </form>
@endsection
