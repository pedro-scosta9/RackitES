
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Gerir Utilizadores</h2>
            </div>
            <a href="{{ route('users.create') }}" type="button" class="mt-4 mb-4 btn btn-primary">Criar Utilizador</a>
        </div>
    </div>
    @if($message=Session::get('sucess'))
        <div class="alert alert-sucess">
            <p>{{message}}</p>
        </div>
    @endif
    <div class="card shadow mb-4" >
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-sm" id="teste" width="100%" >
                    <thead>
                        <tr>
                            <th class="th-sm">Nº</th>
                            <th class="th-sm">Nome</th>
                            <th class="th-sm">Email</th>
                            <th class="th-sm">Papel</th>
                            <th class="th-sm"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key=>$user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>            
                                <td>
                                    @if(!empty($user->getRoleNames()))
                                        @foreach ($user->getRoleNames() as $r)
                                            @if ($r == "User") 
                                                <label class="badge badge-primary">{{$r}}​​​​​​​</label>
                                            @elseif ($r == "Admin") 
                                                <label class="badge badge-danger">{{$r}}​​​​​​​</label>
                                            @elseif ($r == "Premium") 
                                                <label class="badge badge-success">{{$r}}​​​​​​​</label>
                                            @else
                                                <label class="badge badge-light">{{$r}}​​​​​​​</label> 
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <a class='btn btn-info' href="{{route('users.show',$user->id)}}">Ver</a>
                                    <a class='btn btn-primary' href="{{route('users.edit',$user->id)}}">Editar</a>
                                    {!!Form::open(['method'=>'DELETE','route'=>['users.destroy',$user->id],'style'=>'display:inline'])!!}
                                    {!!Form::submit('Remover',['class'=>'btn btn-danger'])!!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#teste').DataTable({
                "aaSorting": [],
                columnDefs: [{
                    orderable: false,
                    targets: 4
                }]
            });
        })
    </script>
    {!! $data->render()!!}
@endsection