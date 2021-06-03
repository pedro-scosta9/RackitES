@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>
                    Criar Utilizador
                </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{route('users.index')}}">Voltar à lista</a>
            </div>
        </div>
    </div>
    @if(count($errors)>0)
        <div class="alert alert-danger">
            <b>Oooooooopss!!</b> Alguma coisa correu mal!!! <br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!!Form::open(array('route'=>'users.store','method'=>'POST'))!!}
    <div class="row">
        <div class="col-xs-12 clo-sm-12 col-md-12">
            <div class="form-group">
                <b>Nome</b>
                {!!Form::text('name',null,array('placeholder'=>'Nome do utilizador','class'=>'form-control'))!!}
            </div>
        </div>
        <div class="col-xs-12 clo-sm-12 col-md-12">
            <div class="form-group">
                <b>E-Mail</b>
                {!!Form::text('email',null,array('placeholder'=>'E-mail','class'=>'form-control'))!!}
            </div>
        </div>
        <div class="col-xs-12 clo-sm-12 col-md-12">
            <div class="form-group">
                <b>Password</b>
                {!!Form::password('password',null,array('placeholder'=>'Password','class'=>'form-control'))!!}
            </div>
        </div>
        <div class="col-xs-12 clo-sm-12 col-md-12">
            <div class="form-group">
                <b>Confirmar Password</b>
                {!!Form::password('confirm-password',null,array('placeholder'=>'Confirmar Password','class'=>'form-control'))!!}
            </div>
        </div>
        <div class="col-xs-12 clo-sm-12 col-md-12">
            <div class="form-group">
                <b>Papel do Utilizador</b>
                {!!Form::select('roles[]',$roles,[],array('class'=>'form-control','multiple'))!!}
            </div>
        </div>
        <div class="col-xs-12 clo-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </div>
    {!!Form::close()!!}
@endsection