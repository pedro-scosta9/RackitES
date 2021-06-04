<?php

namespace App\Http\Controllers;

use App\Models\produto;
use App\Models\categoria;

use App\Models\infoprodutos;

use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function index()
    {
        $produto = produto::all();
        $categoria = categoria::all();

        $infoproduto = infoprodutos::all();
        return view('produtos.index', ['produto' => $produto, 'infoproduto' => $infoproduto, 'categoria' => $categoria]);
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
