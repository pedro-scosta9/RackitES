<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\armazen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\categoria;

class ArmazemController extends Controller
{
    public function index()
    {
        $userid = Auth::user()->id;
        $nomedaslistas = DB::select("select lista_produtos.nome as nome, lista_produtos.id as id from lista_produtos inner join users_has_listaprodutos on lista_produtos.id = users_has_listaprodutos.lista_produtos_id inner join users on users.id = users_has_listaprodutos.users_id where users.id = ?", [$userid]);
        $armazens = [];
        return view('armazens.index', ['armazens' => $armazens, 'nomedaslistas' => $nomedaslistas]);
    }

    public function getList($id)
    {
        $userid = Auth::user()->id;
        $nomedaslistas = DB::select("select lista_produtos.nome as nome, lista_produtos.id as id from lista_produtos inner join users_has_listaprodutos on lista_produtos.id = users_has_listaprodutos.lista_produtos_id inner join users on users.id = users_has_listaprodutos.users_id where users.id = ?", [$userid]);

        $armazens = armazen::all()->where('lista_produtos_id', $id);
        return view('armazens.index', ['armazens' => $armazens, 'nomedaslistas' => $nomedaslistas]);
    }
    public function showcreate($id)
    {
        $nomedaslistas = DB::select("select lista_produtos.nome as nome, lista_produtos.id as id from lista_produtos where lista_produtos.id=?", [$id]);
        return view('armazens.create', ['nomedaslistas' => $nomedaslistas, 'id' => $id]);
    }
    public function create(Request $request, $id)
    {
        $armazens = new armazen();
        $armazens->nome = $request->nome;
        $armazens->descricao = $request->descricao;
        $auxLista = DB::select("select id from lista_produtos where nome=?", [$request->lista]);
      
        foreach ($auxLista as $listaaux) {
            //guardo produto na lista de produtos
            $armazens->lista_produtos_id = $listaaux->id;
            break;
        }

        $armazens->save();
        return redirect()->route('armazens.teste',$id);
    }

    public function showedit(armazen $armazens, $id)
    {
        return view('armazens.edit', ['armazens' => $armazens, 'id' => $id]);
    }

    public function edit(Request $request, armazen $armazens, $id)
    {
        $armazens->nome = $request->nome;
        $armazens->descricao = $request->descricao;
        $armazens->save();
        return redirect()->route('armazens.teste',$id);
    }
    
    public function delete(armazen $armazens, $id)
    {
        $armazens->delete();
        return redirect()->route('armazens.teste',$id);
    }
}
