<?php

namespace App\Http\Controllers;

use App\Models\armazen;
use App\Models\produto;
use App\Models\categoria;

use App\Models\info_produto;

use App\Models\lista_produto;
use App\Models\produtos_has_categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProdutosController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $userid = Auth::user()->id;
        $produto = [];
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

        $armazens = armazen::all()->where('lista_produtos_id', $teste);
        $infoproduto = info_produto::all();
        $produtosCategorias = produtos_has_categoria::all()->where('lista_produtos_id', $teste);
        return view('produtos.index', ['produto' => $produto, 'infoproduto' => $infoproduto, 'nomedaslistas' => $nomedaslistas, 'armazens' => $armazens, 'produtosCategorias' => $produtosCategorias]);
    }
    public function getList($id){
        $userid = Auth::user()->id;
        $userHasLista = DB::select("SELECT * FROM users_has_listaprodutos WHERE users_id = ? and lista_produtos_id = ? ",[$userid,$id]);
        if(empty($userHasLista)){
            return redirect()->route('produtos.index');
        }
        $nomedaslistas = DB::select("select lista_produtos.nome as nome, lista_produtos.id as id from lista_produtos inner join users_has_listaprodutos on lista_produtos.id = users_has_listaprodutos.lista_produtos_id inner join users on users.id = users_has_listaprodutos.users_id where users.id = ?", [$userid]);
        $produto = DB::select("select produtos.id as 'id', produtos.codigoBarras as 'codigoBarras', produtos.nome as 'nome', categorias.nome as 'categoria' from produtos inner join produtos_has_categorias on produtos.id = produtos_has_categorias.produtos_id inner join categorias on categorias.id = produtos_has_categorias.categorias_id where produtos.lista_produtos_id = ?", [$id]);
        $armazens = armazen::all()->where('lista_produtos_id', $id);
        $infoproduto = info_produto::all();
        $produtosCategorias = produtos_has_categoria::all()->where('lista_produtos_id', $id);
        return view('produtos.index', ['produto' => $produto, 'infoproduto' => $infoproduto, 'nomedaslistas' => $nomedaslistas, 'armazens' => $armazens, 'produtosCategorias' => $produtosCategorias]);
    }
    //Pagina create produto existente
    public function showcreate($id)
    {
        $userid = Auth::user()->id;
        $userHasLista = DB::select("SELECT * FROM users_has_listaprodutos WHERE users_id = ? and lista_produtos_id = ? ",[$userid,$id]);
        if(empty($userHasLista)){
            return redirect()->route('produtos.index');
        }
        $nomeProdutos = DB::select("select produtos.nome, produtos.id from produtos inner join lista_produtos on lista_produtos.id = produtos.lista_produtos_id where produtos.lista_produtos_id=?", [$id]);
        $nomeCategoria = DB::select("select categorias.nome,categorias.id from categorias inner join lista_produtos on lista_produtos.id = categorias.lista_produtos_id where lista_produtos_id=?", [$id]);
        $nomeArmazem = DB::select("select armazens.nome,armazens.id from armazens inner join lista_produtos on lista_produtos.id = armazens.lista_produtos_id where lista_produtos_id=?", [$id]);
        return view('produtos.create', ['nomeProdutos' => $nomeProdutos, 'nomeCategoria' => $nomeCategoria, 'nomeArmazem' => $nomeArmazem, 'id' => $id]);
    }

    //Pagina create produto novo
    public function showcreatenovo($id)
    {
        $userid = Auth::user()->id;
        $userHasLista = DB::select("SELECT * FROM users_has_listaprodutos WHERE users_id = ? and lista_produtos_id = ? ",[$userid,$id]);
        if(empty($userHasLista)){
            return redirect()->route('produtos.index');
        }
        $nomedaslistas = DB::select("select lista_produtos.nome as nome, lista_produtos.id as id from lista_produtos where lista_produtos.id=?", [$id]);
        $nomeCategoria = DB::select("select categorias.nome,categorias.id from categorias inner join lista_produtos on lista_produtos.id = categorias.lista_produtos_id where lista_produtos_id=?", [$id]);
        $nomeArmazem = DB::select("select armazens.nome,armazens.id from armazens inner join lista_produtos on lista_produtos.id = armazens.lista_produtos_id where lista_produtos_id=?", [$id]);
        
        return view('produtos.createnovo', ['nomeCategoria' => $nomeCategoria, 'nomeArmazem' => $nomeArmazem, 'nomedaslistas' => $nomedaslistas, 'id' => $id]);
    }

    //Criar produto existente
    public function createInfoProd(Request $request, $id)
    {
        $infoproduto = new info_produto();
        $auxprodutoID = DB::select("select produtos.id from produtos where nome=?", [$request->nome]);
        $auxarmazemID = DB::select("select armazens.id from armazens where nome=?", [$request->armazem]);
        foreach ($auxprodutoID as $aux) {
            $idaux = $aux->id;
            break;
        }

        foreach ($auxarmazemID as $aux) {
            $idArmazemAUX = $aux->id;
            break;
        }
        $infoproduto->produtosID = $idaux;
        $infoproduto->armazemID = $idArmazemAUX;
        $infoproduto->dataCompra = $request->dataCompra;
        $infoproduto->dataValidade = $request->dataValidade;
        $infoproduto->precoCompra = $request->precoCompra;
        $infoproduto->precoNormal = $request->precoNormal;
        $infoproduto->save();
        return redirect()->route('produtos.teste',$id);
    }

    //Criar produto novo
    public function createInfoProdNovo(Request $request, $id)
    {
        //Crio produto
        $produto = new produto();
        $produto->nome = $request->nomeproduto;

        //fix para ir buscar o id da lista
        $auxLista = DB::select("select id from lista_produtos where nome=?", [$request->lista]);
        $produto->codigoBarras = $request->codigoBarras;
        foreach ($auxLista as $listaaux) {
            //guardo produto na lista de produtos
            $produto->lista_produtos_id = $listaaux->id;
            break;
        }
        $produto->save();

        //vou buscar o id do produt e categoria
        $auxprodutoID = DB::select("select produtos.id from produtos where nome=?", [$produto->nome]);
        $auxcateogiraID = DB::select("select categorias.id from categorias where nome=?", [$request->categoria]);

        //fix para ir buscar o id
        foreach ($auxprodutoID as $aux) {
            $idaux = $aux->id;
            break;
        }

        //fix para ir buscar o id
        foreach ($auxcateogiraID as $aux) {
            $idcat = $aux->id;
            break;
        }
        //guardo a relação
        $prodCat = new produtos_has_categoria();
        $prodCat->produtos_id = $idaux;
        $prodCat->categorias_id = $idcat;
        $prodCat->save();
        $infoproduto = new info_produto();


        $auxarmazemID = DB::select("select armazens.id from armazens where nome=?", [$request->armazem]);
        foreach ($auxarmazemID as $aux) {
            $idArmazemAUX = $aux->id;
            break;
        }
        $infoproduto->produtosID = $idaux;
        $infoproduto->armazemID = $idArmazemAUX;
        $infoproduto->dataCompra = $request->dataCompra;
        $infoproduto->dataValidade = $request->dataValidade;
        $infoproduto->precoCompra = $request->precoCompra;
        $infoproduto->precoNormal = $request->precoNormal;
        $infoproduto->save();
        return redirect()->route('produtos.teste',$id);
    }

    public function showedit(produto $produto, Request $request, $id)
    {
        $userid = Auth::user()->id;
        $userHasLista = DB::select("SELECT * FROM users_has_listaprodutos WHERE users_id = ? and lista_produtos_id = ? ",[$userid,$id]);
        if(empty($userHasLista)){
            return redirect()->route('produtos.index');
        }
        $nomeProdutos = DB::select("select produtos.nome, produtos.id from produtos inner join lista_produtos on lista_produtos.id = produtos.lista_produtos_id where produtos.lista_produtos_id=?", [$id]);
        $nomeCategoria = DB::select("select categorias.nome,categorias.id from categorias inner join lista_produtos on lista_produtos.id = categorias.lista_produtos_id where lista_produtos_id=?", [$id]);
        $nomeArmazem = DB::select("select armazens.nome,armazens.id from armazens inner join lista_produtos on lista_produtos.id = armazens.lista_produtos_id where lista_produtos_id=?", [$id]);
        return view('produtos.edit', ['produto' => $produto, 'nomeProdutos' => $nomeProdutos, 'nomeCategoria' => $nomeCategoria, 'nomeArmazem' => $nomeArmazem, 'id' => $id]);
    }
    public function edit(Request $request, produto $produto, $id)
    {
        $produto->nome = $request->nome;
        $produto->codigoBarras = $request->codigoBarras;
        $produto->save();

        DB::table('produtos_has_categorias')->where('produtos_id', $produto->id)->delete();
        $auxcateogiraID = DB::select("select categorias.id from categorias where nome=?", [$request->categoria]);
        //fix para ir buscar o id
        foreach ($auxcateogiraID as $aux) {
            $idcat = $aux->id;
            break;
        }
        $prodCat = new produtos_has_categoria();
        $prodCat->produtos_id = $produto->id;
        $prodCat->categorias_id = $idcat;
        $prodCat->save();
        return redirect()->route('produtos.teste',$id);
    }


    //FIQUEI AQUI
    public function showeditinfo(info_produto $infoprod, $id)
    {
        $userid = Auth::user()->id;
        $userHasLista = DB::select("SELECT * FROM users_has_listaprodutos WHERE users_id = ? and lista_produtos_id = ? ",[$userid,$id]);
        if(empty($userHasLista)){
            return redirect()->route('produtos.index');
        }
        $nomeProdutos = DB::select("select produtos.nome, produtos.id from produtos inner join lista_produtos on lista_produtos.id = produtos.lista_produtos_id where produtos.lista_produtos_id=?", [$id]);
        $nomeArmazem = DB::select("select armazens.nome,armazens.id from armazens inner join lista_produtos on lista_produtos.id = armazens.lista_produtos_id where lista_produtos_id=?", [$id]);
        return view('produtos.editinfo', ['infoprod' => $infoprod, 'nomeProdutos' => $nomeProdutos, 'nomeArmazem' => $nomeArmazem, 'id' => $id]);
    }
    public function editinfo(Request $request, info_produto $infoprod, $id)
    {
        // $produto = new produto();

        $infoproduto = new info_produto();
        $auxarmazemID = DB::select("select armazens.id from armazens where nome=?", [$request->armazem]);
        foreach ($auxarmazemID as $aux) {
            $idArmazemAUX = $aux->id;
            break;
        }
        $infoproduto->produtosID = $infoprod->produtosID;
        $infoproduto->armazemID = $idArmazemAUX;
        $infoproduto->dataCompra = $request->dataCompra;
        $infoproduto->dataValidade = $request->dataValidade;
        $infoproduto->precoCompra = $request->precoCompra;
        $infoproduto->precoNormal = $request->precoNormal;
        $infoproduto->save();
        DB::table('info_produtos')->where('id', $infoprod->id)->delete();
        return redirect()->route('produtos.teste',$id);
    }

    public function delete(produto $produto, $id)
    {
        $produto->delete();
        return redirect()->route('produtos.teste',$id);
    }
    public function deleteinfo(info_produto $infoproduto)
    {
        DB::table('info_produtos')->where('id', $infoproduto->id)->delete();

        $infoproduto->delete();
        return redirect()->route('produtos.index');
    }
}
