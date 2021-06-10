<?php

namespace App\Http\Controllers;

use App\Models\lista_produto;
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
        return redirect()->route('listaProduto.index');
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
    