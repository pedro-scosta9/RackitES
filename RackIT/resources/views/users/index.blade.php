@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Gerir Utilizadores</h2>
            </div>
            <div class="pull-right">
                <a href="{{route('users.create')}}" class="btn btn-success">Criar Utilizador</a>
            </div>
        </div>
    </div>
    @if($message=Session::get('sucess'))
        <div class="alert alert-sucess">
            <p>{{message}}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>Nº</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Papel</th>
            <th></th>
            </tr>
        @foreach ($data as $key=>$user)
        <tr>
            <td>{{++$i}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>
                {{-- @if(!@empty($user->getRoleNames()))
                    @foreach ($user->getRoleNames() as $r)
                    <label class="badge badge-sucess">{{$r}}</label>
                    @endforeach 
                @endif --}}
            </td> 
            <td>
                <a class='btn btn-info' href="{{route('users.show',$user->id)}}">Ver</a>
                <a class='btn btn-primary' href="{{route('users.edit',$user->id)}}">Editar</a>
                {!!Form::open(['method'=>'DELETE','route'=>['users.destroy',$user->id],'style'=>'display:inline'])!!}
                {!!Form::submit('Remover',['class'=>'btn btn-danger'])!!}
            </td>
        </tr>
        @endforeach
    </table>
    {!! $data->render()!!}
@endsection