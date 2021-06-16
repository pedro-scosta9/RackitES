<?php

namespace App\Http\Controllers;

use App\Models\lista_produto;
use App\Models\User;
use App\Models\users_has_listaproduto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ListaProdutosController extends Controller
{
    public function index(Request $request)
    {
        $userid = Auth::user()->id;
        
        // $nomedaslistas = DB::select("select * from lista_produtos inner join users_has_listaprodutos on lista_produtos.id = users_has_listaprodutos.lista_produtos_id inner join users on users.id = users_has_listaprodutos.users_id where users.id = ?", [$userid]);
        $nomedaslistas = DB::select("select lista_produtos.nome as nome, lista_produtos.id as id from lista_produtos inner join users_has_listaprodutos on lista_produtos.id = users_has_listaprodutos.lista_produtos_id inner join users on users.id = users_has_listaprodutos.users_id where users.id = ?", [$userid]);

        
        return view('listaProduto.index', [ 'nomedaslistas' => $nomedaslistas]);
        
    }
    public function showcreate()
    {
        return view('listaProduto.create');
    }


    public function create(Request $request)
    {
        $listaProduto = new lista_produto();
        $listaProduto->nome = $request->nome;

        $listaProduto->save();
        $userLista=  new users_has_listaproduto();
        $userid = Auth::user()->id;
        $userLista-> users_id = $userid;
        $userLista -> lista_produtos_id = $listaProduto -> id;
        $userLista -> save();
        $nomedaslistas = DB::select("select lista_produtos.nome as nome, lista_produtos.id as id from lista_produtos inner join users_has_listaprodutos on lista_produtos.id = users_has_listaprodutos.lista_produtos_id inner join users on users.id = users_has_listaprodutos.users_id where users.id = ?", [$userid]);
        return redirect()->route('listaProduto.index',[ 'nomedaslistas' => $nomedaslistas]);
    }
    

    public function showadd($listaProduto)
    {
        return view('listaProduto.add', ['listaProduto' => $listaProduto]);
    }

    public function add(Request $request, $listaProduto)
    {   
        // $valor= $request->validate($request,['email' => 'required']);
       
        $email = $request->email;
        // return view('home');

        //   $userid = DB::select('select users.id FROM users where users.email = ?',[$email]) ;
        $userid = DB::table('users')->where('email', $email)->first();
        $has = DB::select('select * from users_has_listaprodutos where users_id = ? and lista_produtos_id = ?',[$userid -> id, $listaProduto]);
        //  $nomedaslistas = DB::select("select lista_produtos.nome as nome, lista_produtos.id as id from lista_produtos inner join users_has_listaprodutos on lista_produtos.id = users_has_listaprodutos.lista_produtos_id inner join users on users.id = users_has_listaprodutos.users_id where users.id = ?", [$userid]);
        $nomedaslistas = [];
        $user = User::find($userid -> id);
        $role = $user->hasRole('Admin');
        if (!empty($userid) && empty($has) && !$role) {
            $userLista=  new users_has_listaproduto();
            $userLista->lista_produtos_id = $listaProduto;
            $userLista-> users_id = $userid-> id;
            $userLista->save();
            return redirect()->route('listaProduto.index', [ 'nomedaslistas' => $nomedaslistas]);
        } else if($role) {
            return redirect()->route('listaProduto.index', [ 'nomedaslistas' => $nomedaslistas]);
        }
        else {
            return view('listaProduto.add',['erro'=>'erro', 'listaProduto' => $listaProduto]);
        }
    }


    public function showedit(lista_produto $listaProduto)
    
    
    {
        return view('listaProduto.edit', ['listaProduto' => $listaProduto]);
    }




    public function edit(Request $request, lista_produto $listaProduto)
    {
        $listaProduto->nome = $request->nome;
        $listaProduto->save();
        return redirect()->route('listaProduto.index');
    }



    public function delete(lista_produto $listaProduto)
    {
        $listaProduto->delete();
        return redirect()->route('listaProduto.index');
    }
    }
    