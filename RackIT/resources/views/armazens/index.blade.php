@extends('layouts.app')
@section('title', 'Lista de armazens')
@section('page', 'armazens')
@section('content')
    <div class="row">
        <div class="col-12">
            <form method="POST" action="{{ route('armazens.index') }}">
                @csrf
                <select class="form-select" size="1" name="SelectListaProdutos" onchange="teste();" id="testingout">
                    @if (Request::path() == "armazens")
                        <option selected disabled>Escolha uma lista</option>
                    @endif
                    @foreach ($nomedaslistas as $listas)
                        @if (Request::path() == "armazens/$listas->id" )
                            <option value="{{ $listas->id }}" selected>{{ $listas->nome }}</option>
                            @php($page = $listas->id)
                        @else
                            <option value="{{ $listas->id }}">{{ $listas->nome }}</option>
                        @endif
                    @endforeach
                </select>
            </form>
        </div>
    </div>
    <br>
    @if (Request::path() != "armazens")
        <a href="{{ route('armazens.inserir',$page) }}" type="button" class="mt-4 mb-4 btn btn-primary">Inserir armazens</a>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Editar</th>
                                <th>Apagar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($armazens as $cat)
                                <tr>
                                    <td>{{ $cat->id }}</td>
                                    <td>{{ $cat->nome }}</td>
                                    <td>
                                        <a href="{{ route('armazens.edit',[$cat,$page]) }}" type="button" class="btn btn-success font-weight-bold w-100">
                                            <i class="fa fa-edit" aria-hidden="true"> </i>  
                                            Editar
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('armazens.delete',[$cat,$page]) }}" type="button" class="btn btn-danger font-weight-bold w-100">
                                            <i class="fa fa-trash" aria-hidden="true"> </i>  
                                            Apagar
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        
    @endif
    <script>
        function teste(data){
            var a = document.getElementById("testingout");
            console.log(a.value);
            var pass = a.value
            var url = '{{ route("armazens.teste", ":pass") }}';
            url = url.replace(':pass', pass);
            window.location.href=url;
        }
    </script>
@endsection
