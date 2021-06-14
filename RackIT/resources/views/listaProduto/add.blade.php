
@extends('layouts.app')
@section('title', 'Adicionar user ')
@section('page', 'Criar')
@section('content')
    <form method="POST" action="{{ route('listaProduto.adicionarUser',$listaProduto) }}">
        @csrf
        @method('patch')
        <div class="row">
            <div class="col-md-12" >
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" required name="email" id="email" class="form-control">
                </div>
            </div>
        </div>
        @if (!empty($erro))
            <p class="text-danger">ERRO- E-MAIL INVALIDO </p>
        @endif
        <button type="submit" class="mt-4 mb-4 btn btn-primary">Enviar</button>
    </form>
@endsection