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
                    @else
                        <option value="{{ $listas->id }}">{{ $listas->nome }}</option>
                    @endif
                @endforeach
                {{-- {!! Form::select('size', array($nomedaslistas->id => $nomedaslistas->nome)) !!} --}}
            </select>
        </form>
    </div>
</div>
{{-- {{$teste}} --}}
<br>
<a href="{{ route('armazens.inserir') }}" type="button" class="mt-4 mb-4 btn btn-primary">Inserir armazens</a>

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
                                <td><a href="{{ route('armazens.edit',$cat) }}" type="button" class="btn btn-success font-weight-bold w-100"><i class="fa fa-edit" aria-hidden="true"> </i>  Editar</a></td>
                                <td><a href="{{ route('armazens.delete',$cat) }}" type="button" class="btn btn-danger font-weight-bold w-100"><i class="fa fa-trash" aria-hidden="true"> </i>  Apagar</a></td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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
{{-- @foreach ($produtos as $produto)
    <hr>
        <p>Produto: {{$produto->id}} - {{$produto->nome}} <br>
        Descriçao: {{$produto->descricao}} <br>
        Quantidade: {{$produto->quantidade}}x<br>
        Preço: {{$produto->preco}}€<br>
        Criado: {{$produto->created_at}}<br>
        Editado: {{$produto->updated_at}}
        </p>
    @endforeach
    <hr>
@endsection --}}
