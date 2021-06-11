@extends('layouts.app')
@section('title', 'Editar Categoria')
@section('page', 'Editar')
@section('content')
    <a href="{{ route('categoria.teste',$id) }}" type="button" class="mt-0 mb-4 btn btn-primary">
        <i class="fa fa-arrow-left" aria-hidden="true"></i> 
        Voltar 
    </a>
    <form method="POST" action="{{ route('categoria.editar', [$categoria, $id]) }}">
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
