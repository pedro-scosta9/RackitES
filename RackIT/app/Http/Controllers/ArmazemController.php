<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\armazen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\categoria;

class ArmazemController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function showcreate()
    {
        $userid = Auth::user()->id;
        // $nomedaslistas = DB::select("select * from lista_produtos inner join users_has_listaprodutos on lista_produtos.id = users_has_listaprodutos.lista_produtos_id inner join users on users.id = users_has_listaprodutos.users_id where users.id = ?", [$userid]);
        $nomedaslistas = DB::select("select lista_produtos.nome as nome, lista_produtos.id as id from lista_produtos inner join users_has_listaprodutos on lista_produtos.id = users_has_listaprodutos.lista_produtos_id inner join users on users.id = users_has_listaprodutos.users_id where users.id = ?", [$userid]);
        return view('armazens.create', ['nomedaslistas' => $nomedaslistas]);
    }
    public function create(Request $request)
    {
        $armazens = new armazen();
        $armazens->nome = $request->nome;
        $armazens->descricao = $request->descricao;
        
        $userid = Auth::user()->id;
        $nomedaslistas = DB::select("select lista_produtos.nome as nome, lista_produtos.id as id from lista_produtos inner join users_has_listaprodutos on lista_produtos.id = users_has_listaprodutos.lista_produtos_id inner join users on users.id = users_has_listaprodutos.users_id where users.id = ?", [$userid]);

       //fix para ir buscar o id da lista
       $auxLista = DB::select("select id from lista_produtos where nome=?", [$request->lista]);
      
       foreach ($auxLista as $listaaux) {
           //guardo produto na lista de produtos
           $armazens->lista_produtos_id = $listaaux->id;
           break;
       }
       
        
        $armazens->save();
        return redirect()->route('armazens.index');
    }

    public function showedit(armazen $armazens)
    {
        return view('armazens.edit', ['armazens' => $armazens]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function edit(Request $request, armazen $armazens)
    {
        $armazens->nome = $request->nome;
        $armazens->descricao = $request->descricao;
        $armazens->save();
        return redirect()->route('armazens.index');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function delete(armazen $armazens)
    {
        $armazens->delete();
        return redirect()->route('armazens.index');
    }
    public function show(armazen $armazens)
    {
        return view('armazens.show', compact('armazens'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\armazen  $armazens
     * @return \Illuminate\Http\Response
     */
   
    public function destroy(armazen $armazens)
    {
        $armazens->delete();

        return redirect()->route('armazens.index')
            ->with('success', 'Armazem deleted successfully');
    }
}
