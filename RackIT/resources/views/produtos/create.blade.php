@extends('layouts.app')
@section('title', 'Criar Categoria')
@section('page', 'Criar')
@section('content')
    <form method="POST" action="{{ route('produtos.insert') }}">
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
