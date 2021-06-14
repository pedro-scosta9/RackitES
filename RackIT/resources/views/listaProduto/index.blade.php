
@extends('layouts.app')
@section('title', 'Lista de Categorias')
@section('page', 'Categorias')
@section('content')



{{-- {{$teste}} --}}
<br>
<a href="{{ route('listaProduto.inserir') }}" type="button" class="mt-4 mb-4 btn btn-primary">Inserir lista de Produtos</a>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Add User</th>
                            <th>Editar</th>
                            <th>Apagar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nomedaslistas as $cat)
                            <tr>
                                <td>{{ $cat->id }}</td>
                                <td>{{ $cat->nome }}</td>
                                <td><a href="{{ route('listaProduto.addUser',$cat->id) }}" type="button" class="btn btn-primary font-weight-bold w-100"><i class="fa fa-plus" aria-hidden="true"> </i> Atribuir Utilizador</a></td>
                                <td><a href="{{ route('listaProduto.edit',$cat->id) }}" type="button" class="btn btn-success font-weight-bold w-100"><i class="fa fa-edit" aria-hidden="true"> </i>  Editar</a></td>
                                <td><a href="{{ route('listaProduto.delete',$cat->id) }}" type="button" class="btn btn-danger font-weight-bold w-100"><i class="fa fa-trash" aria-hidden="true"> </i>  Apagar</a></td>



                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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