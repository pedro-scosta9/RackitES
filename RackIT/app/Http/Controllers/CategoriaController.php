<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use App\Models\lista_produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class CategoriaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:category-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $userid = Auth::user()->id;
        $nomedaslistas = DB::select("select lista_produtos.nome as nome, lista_produtos.id as id from lista_produtos inner join users_has_listaprodutos on lista_produtos.id = users_has_listaprodutos.lista_produtos_id inner join users on users.id = users_has_listaprodutos.users_id where users.id = ?", [$userid]);
        $categoria = [];
        return view('categoria.index', ['categoria' => $categoria, 'nomedaslistas' => $nomedaslistas]);
    }
    public function getList($id)
    {
        $userid = Auth::user()->id;
        $nomedaslistas = DB::select("select lista_produtos.nome as nome, lista_produtos.id as id from lista_produtos inner join users_has_listaprodutos on lista_produtos.id = users_has_listaprodutos.lista_produtos_id inner join users on users.id = users_has_listaprodutos.users_id where users.id = ?", [$userid]);
        $categoria = categoria::all()->where('lista_produtos_id', $id);
        return view('categoria.index', ['categoria' => $categoria, 'nomedaslistas' => $nomedaslistas]);
    }
    public function showcreate($id)
    {
        $nomedaslistas = DB::select("select lista_produtos.nome as nome, lista_produtos.id as id from lista_produtos where lista_produtos.id=?", [$id]);
        return view('categoria.create', ['nomedaslistas' => $nomedaslistas, 'id' => $id]);
    }
    public function create(Request $request, $id)
    {
        $categoria = new categoria();
        $categoria->nome = $request->nome;
        $categoria->lista_produtos_id = $id;
        $categoria->save();
        return redirect()->route('categoria.teste',$id);
    }

    public function showedit(categoria $categoria, $id)
    {
        return view('categoria.edit', ['categoria' => $categoria, 'id' => $id]);
    }

    public function edit(Request $request, categoria $categoria, $id)
    {
        $categoria->nome = $request->nome;
        $categoria->save();
        return redirect()->route('categoria.teste',$id);
    }

    public function delete(categoria $categoria, $id)
    {
        $categoria->delete();
        return redirect()->route('categoria.teste',$id);
    }
}
