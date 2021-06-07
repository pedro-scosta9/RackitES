<?php

namespace App\Http\Controllers;

use App\Models\produto;
use App\Models\categoria;

use App\Models\infoprodutos;

use App\Models\lista_produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProdutosController extends Controller
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
        $produto = produto::all()->where('lista_produtos_id', $teste); 
        $categoria = categoria::all();

        $infoproduto = infoprodutos::all();
        return view('produtos.index', ['produto' => $produto, 'infoproduto' => $infoproduto, 'categoria' => $categoria, 'nomedaslistas' => $nomedaslistas ]);
    }

    public function showcreate()
    {
        return view('produtos.create');
    }
    public function create(Request $request)
    {
        $produto = new produto();
        $produto->nome = $request->nome;
        $produto->codigoBarras = $request->codigoBarras;
        $produto->save();
        return redirect()->route('produtos.index');
    }

    public function showedit(produto $produto)
    {
        return view('produtos.edit', ['produto' => $produto]);
    }

    public function edit(Request $request, produto $produto)
    {
        $produto = new produto();
        $produto->nome = $request->nome;
        $produto->codigoBarras = $request->codigoBarras;
        $produto->save();
        return redirect()->route('produtos.index');
    }

    public function delete(produto $produto)
    {
        $produto->delete();
        return redirect()->route('produtos.index');
    }
}
