<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\lista_produto;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        //Atribui a role User(default) ao User
        $user->assignRole('User');
        //Guardo id do user
        $user_id = $user->id;

        //Criar listaprodutos
        $lista = lista_produto::create([
            'nome' => "Lista " . $data['name'],
        ]);
        //Guardo id da lista_produtos
        $lista_produtos_id = $lista->id;

        //Inserir dados na users_has_listaprodutos
        DB::insert('insert into users_has_listaprodutos (users_id,lista_produtos_id) values (?,?)', [$user_id, $lista_produtos_id]);


        //Criar categorias default da lista (Bebidas, Carnes, Peixes, Congelados, Cereais, Frutas e Vegetais)
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Bebidas', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Carnes', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Peixes', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Congelados', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Cereais', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Frutas', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Vegetais', $lista_produtos_id]);



        //Criar armazens default na listaProdutos 
        DB::insert('INSERT INTO armazens (id, nome, descricao, imagem, lista_produtos_id, created_at, updated_at) VALUES (NULL, "Frigorifico", "", "", ?, NULL, NULL)', [$lista_produtos_id]);
        DB::insert('INSERT INTO armazens (id, nome, descricao, imagem, lista_produtos_id, created_at, updated_at) VALUES (NULL, "Garagem", "", "", "?", NULL, NULL)', [$lista_produtos_id]);
        DB::insert('INSERT INTO armazens (id, nome, descricao, imagem, lista_produtos_id, created_at, updated_at) VALUES (NULL, "Cozinha", "", "", "?", NULL, NULL)', [$lista_produtos_id]);
        //$user->assignRole(Role::where('name','User'));
        return $user;
    }
}
