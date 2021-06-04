<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categoria = categoria::all();
        return view('categoria.index', ['categoria' => $categoria]);
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
