@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar utilizador</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-info" href="{{route('users.index')}}">Lista de utilizadores</a>
            </div>
        </div>
    </div>
    @if(count($errors)>0)
        <div class="alert alert-danger">
            <b>Ooooooooooooooops</b> existem erros!!!!!<br/><br/>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::model($user, ['method'=>'PATCH','route'=>['users.update',$user->id]]) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <b>Nome</b>
                {!! Form::text('name', null, array('placeholder'=>'Nome','class'=>'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <b>Email</b>
                {!! Form::email('email', null,array('placeholder'=>'Nome','class'=>'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <b>Password</b>
                {!! Form::password('password', array('class'=>'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <b>Confirmar Password</b>
                {!! Form::password('confirm-password', array('class'=>'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <b>Papéis</b>
                {!! Form::select('roles[]', $roles, $userRole, array('class'=>'form-control','multiple')) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <button type="submit" class="mt-4 mb-4 btn btn-primary">Enviar</button>
    </div>
    {!! Form::close() !!}
@endsection
