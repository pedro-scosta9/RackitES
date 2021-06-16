<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\lista_produto;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = User::orderBy('id', 'DESC')->paginate(5);
        return view('users.index', compact('data'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        //Criar listaprodutos
        $lista = lista_produto::create([
            'nome' => "Lista $user->name",
        ]);
        //Guardo id da lista_produtos
        $lista_produtos_id = $lista->id;

        //Inserir dados na users_has_listaprodutos
        DB::insert('insert into users_has_listaprodutos (users_id,lista_produtos_id) values (?,?)', [$user->id, $lista_produtos_id]);
        $useridadmin = Auth::user()->id;
        DB::insert('insert into users_has_listaprodutos (users_id,lista_produtos_id) values (?,?)', [$useridadmin, $lista_produtos_id]);


        //Criar categorias default da lista (Bebidas, Carnes, Peixes, Congelados, Cereais, Frutas e Vegetais)
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Bebidas', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Carnes', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Peixes', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Congelados', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Cereais', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Frutas', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Vegetais', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Outros', $lista_produtos_id]);

        //Criar armazens default na listaProdutos 
        DB::insert('INSERT INTO armazens (id, nome, descricao, imagem, lista_produtos_id, created_at, updated_at) VALUES (NULL, "Frigorifico", "", "", ?, NULL, NULL)', [$lista_produtos_id]);
        DB::insert('INSERT INTO armazens (id, nome, descricao, imagem, lista_produtos_id, created_at, updated_at) VALUES (NULL, "Garagem", "", "", ?, NULL, NULL)', [$lista_produtos_id]);
        DB::insert('INSERT INTO armazens (id, nome, descricao, imagem, lista_produtos_id, created_at, updated_at) VALUES (NULL, "Cozinha", "", "", ?, NULL, NULL)', [$lista_produtos_id]);
        return redirect()->route('users.index')->with('success', 'Utilizador criado com sucesso.');
    }
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('users.edit', compact('user', 'roles', 'userRole'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
        $user = User::find($id);
        $user->roles()->detach();
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input['password'] = $user->password;
        }
        DB::update('update users set name = ? , password = ?, email = ? where users.id = ?',[$request->name,$input['password'],$request->email,$id]);
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')->with('success', 'Utilizador atualizado com sucesso.');
    }
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')->with('success', 'Utilizador removido com sucesso.');
    }
}
