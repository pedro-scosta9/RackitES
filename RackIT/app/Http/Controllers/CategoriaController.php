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
        $categoria = categoria::all()->where('lista_produtos_id', $teste);
        return view('categoria.index', ['categoria' => $categoria, 'nomedaslistas' => $nomedaslistas]);
    }
    public function refreshlista(Request $request)
    {
        $userid = Auth::user()->id;
        $nomedaslistas = DB::select("select lista_produtos.nome as nome, lista_produtos.id as id from lista_produtos inner join users_has_listaprodutos on lista_produtos.id = users_has_listaprodutos.lista_produtos_id inner join users on users.id = users_has_listaprodutos.users_id where users.id = ?", [$userid]);
        $listaid = $request->SelectListaProdutos;
        $categoria = categoria::all()->where('lista_produtos_id', $listaid);
        return view('categoria.refresh', ['categoria' => $categoria, 'nomedaslistas' => $nomedaslistas]);
    }

    public function showcreate()
    {
        return view('categoria.create');
    }
    public function create(Request $request)
    {
        $categoria = new categoria();
        $categoria->nome = $request->nome;

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
