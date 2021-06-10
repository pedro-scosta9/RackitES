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
    public function index(Request $request)
    {
        $userid = Auth::user()->id;
        // $nomedaslistas = DB::select("select * from lista_produtos inner join users_has_listaprodutos on lista_produtos.id = users_has_listaprodutos.lista_produtos_id inner join users on users.id = users_has_listaprodutos.users_id where users.id = ?", [$userid]);
        $nomedaslistas = DB::select("select lista_produtos.nome as nome, lista_produtos.id as id from lista_produtos inner join users_has_listaprodutos on lista_produtos.id = users_has_listaprodutos.lista_produtos_id inner join users on users.id = users_has_listaprodutos.users_id where users.id = ?", [$userid]);
        $input = $request->all();
        if (!empty($input['SelectListaProdutos'])) {
            $teste = $request->SelectListaProdutos;
        } else {
            foreach ($nomedaslistas as $lista) {
                $teste = $lista->id;
                break;
            }
        }
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

    public function showcreate()
    {
        $userid = Auth::user()->id;
        // $nomedaslistas = DB::select("select * from lista_produtos inner join users_has_listaprodutos on lista_produtos.id = users_has_listaprodutos.lista_produtos_id inner join users on users.id = users_has_listaprodutos.users_id where users.id = ?", [$userid]);
        $nomedaslistas = DB::select("select lista_produtos.nome as nome, lista_produtos.id as id from lista_produtos inner join users_has_listaprodutos on lista_produtos.id = users_has_listaprodutos.lista_produtos_id inner join users on users.id = users_has_listaprodutos.users_id where users.id = ?", [$userid]);
        return view('categoria.create', ['nomedaslistas' => $nomedaslistas]);
    }
    public function create(Request $request)
    {
        $categoria = new categoria();
        $categoria->nome = $request->nome;
        $userid = Auth::user()->id;
        $nomedaslistas = DB::select("select lista_produtos.nome as nome, lista_produtos.id as id from lista_produtos inner join users_has_listaprodutos on lista_produtos.id = users_has_listaprodutos.lista_produtos_id inner join users on users.id = users_has_listaprodutos.users_id where users.id = ?", [$userid]);

       //fix para ir buscar o id da lista
       $auxLista = DB::select("select id from lista_produtos where nome=?", [$request->lista]);
      
       foreach ($auxLista as $listaaux) {
           //guardo produto na lista de produtos
           $categoria->lista_produtos_id = $listaaux->id;
           break;
       }
       
        
        $categoria->save();
        return redirect()->route('categoria.index');
    }

    public function showedit(categoria $categoria)
    {
        return view('categoria.edit', ['categoria' => $categoria]);
    }

    public function edit(Request $request, categoria $categoria)
    {
        $categoria->nome = $request->nome;
        $categoria->save();
        return redirect()->route('categoria.index');
    }

    public function delete(categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('categoria.index');
    }
}
