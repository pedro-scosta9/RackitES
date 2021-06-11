@extends('layouts.app')
@section('title', 'Editar Armazem')
@section('page', 'Editar')
@section('content')
    <form method="POST" action="{{ route('armazens.editar', [$armazens, $id]) }}">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" required name="nome" id="nome" value="{{ $armazens->nome }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="nome">Descricao</label>
                    <input type="text" required name="descricao" id="descricao" value="{{ $armazens->descricao }}" class="form-control">
                </div>
            </div>
        </div>
        <button type="submit" class="mt-4 mb-4 btn btn-primary">Enviar</button>
    </form>
@endsection
