<?php

use App\Http\Controllers\ArmazemController;
use App\Http\Controllers\ListaProdutosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\Info;
use App\Http\Controllers\DefinicoesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/infopremium', [App\Http\Controllers\infopremiumController::class, 'index'])->name('infopremium.index'); 

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProdutosController::class);
   

    // Route::resource('category', CategoriaController::class);

    // ROTAS CATEGORIAS
    Route::get('categoria/add/lista/{id}', [CategoriaController::class, 'showcreate'])->name('categoria.inserir');
    Route::post('categoria/lista/{id}', [CategoriaController::class, 'create'])->name('categoria.insert');

    // Route::post('categorias', [CategoriaController::class, 'refreshlista'])->name('categoria.refresh');

    Route::get('categoria/{categoria}/edit/lista/{id}', [CategoriaController::class, 'showedit'])->name('categoria.edit');
    Route::put('categoria/{categoria}/{id}', [CategoriaController::class, 'edit'])->name('categoria.editar');

    Route::get('categoria/{categoria}/delete/lista/{id}', [CategoriaController::class, 'delete'])->name('categoria.delete');
    Route::get('categoria/{listID}', [CategoriaController::class, 'getList'])->name('categoria.teste');
    Route::get('categoria', [CategoriaController::class, 'index'])->name('categoria.index');


    // ROTAS PRODUTOS
    Route::get('produto/add/{id}', [ProdutosController::class, 'showcreate'])->name('produtos.inserir');
    Route::get('produto/addnovo/{id}', [ProdutosController::class, 'showcreatenovo'])->name('produtos.inserirnovo');
    Route::post('produto/{id}', [ProdutosController::class, 'create'])->name('produtos.insert');
    Route::post('produto/{id}', [ProdutosController::class, 'createnovo'])->name('produtos.insertnovo');
    Route::post('produtos/{id}', [ProdutosController::class, 'createInfoProd'])->name('produtos.insertInfo');
    Route::post('produto/{id}', [ProdutosController::class, 'createInfoProdNovo'])->name('produtos.insertInfoNovo');

    Route::get('produto/{produto}/edit/lista/{id}', [ProdutosController::class, 'showedit'])->name('produtos.edit');
    Route::put('produto/{produto}/{id}', [ProdutosController::class, 'edit'])->name('produtos.editar');

    Route::get('produto/{infoprod}/edit-info/lista/{id}', [ProdutosController::class, 'showeditinfo'])->name('produtos.editinfo');
    Route::put('produtos/{infoprod}/{id}', [ProdutosController::class, 'editinfo'])->name('produtos.editarinfo');

    Route::get('produto/{produto}/delete/{id}', [ProdutosController::class, 'delete'])->name('produtos.delete');
    Route::get('produto/{infoprod}/delete-info', [ProdutosController::class, 'deleteinfo'])->name('produtos.deleteinfo');

    Route::get('produto/{listID}', [ProdutosController::class, 'getList'])->name('produtos.teste');
    Route::get('produto', [ProdutosController::class, 'index'])->name('produtos.index');



    // ROTAS ARMAZEM
    
    
    Route::get('armazens/add/lista/{id}', [ArmazemController::class, 'showcreate'])->name('armazens.inserir');
    Route::post('armazens/{id}', [ArmazemController::class, 'create'])->name('armazens.insert');
    
    // Route::post('categorias', [CategoriaController::class, 'refreshlista'])->name('categoria.refresh');
    
    Route::get('armazens/{armazens}/edit/lista/{id}', [ArmazemController::class, 'showedit'])->name('armazens.edit');
    Route::put('armazens/{armazens}/{id}', [ArmazemController::class, 'edit'])->name('armazens.editar');
    
    Route::get('armazens/{armazens}/delete/lista/{id}', [ArmazemController::class, 'delete'])->name('armazens.delete');
    
    Route::get('armazens/{listID}', [ArmazemController::class, 'getList'])->name('armazens.teste');
    Route::get('armazens', [ArmazemController::class, 'index'])->name('armazens.index');
    
   
    
    // Route::resource('listaProduto', CategoriaController::class);

    // ROTAS Listas produtos
    Route::get('listaProduto/add', [ListaProdutosController::class, 'showcreate'])->name('listaProduto.inserir');
    Route::post('listaProduto', [ListaProdutosController::class, 'create'])->name('listaProduto.insert');
    
    // Route::post('listaProduto', [CategoriaController::class, 'refreshlista'])->name('categoria.refresh');
    Route::get('listaProduto/{listaProduto}/edit', [ListaProdutosController::class, 'showedit'])->name('listaProduto.edit');
    Route::put('listaProduto/{listaProduto}', [ListaProdutosController::class, 'edit'])->name('listaProduto.editar');
    Route::get('listaProduto/{listaProduto}/add', [ListaProdutosController::class, 'showadd'])->name('listaProduto.addUser');
    Route::patch('listaProdutos/{listaProduto}', [ListaProdutosController::class, 'add'])->name('listaProduto.adicionarUser');

    Route::get('listaProduto/{listaProduto}/edit-user', [ListaProdutosController::class, 'showedituser'])->name('listProdutoedituser');
    Route::put('listaProdutoss/{listaProduto}', [ListaProdutosController::class, 'edituser'])->name('listaProduto.editaruser');  
    Route::get('listaProduto/{listaProduto}/delete', [ListaProdutosController::class, 'delete'])->name('listaProduto.delete');
    Route::get('listaProduto', [ListaProdutosController::class, 'index'])->name('listaProduto.index');

    //ROTAS DEFINICOES
    Route::get('definicoes/{id}', [DefinicoesController::class, 'update' ])->name('definicoes.update');
    Route::get('definicoes/{definicoes}/edit', [DefinicoesController::class, 'showedit'])->name('definicoes.edit');
    Route::get('definicoes', [DefinicoesController::class, 'index'])->name('definicoes.index');
    
    

});



// Route::get('produtos', [ProdutosController::class, 'index'])->name('produtos.index');


// Route::get('categoria/add', [CategoriaController::class, 'showcreate'])->name('categoria.inserir');
// Route::post('categoria', [CategoriaController::class, 'create'])->name('categoria.insert');

// Route::get('categoria/{categoria}/edit', [CategoriaController::class, 'showedit'])->name('categoria.edit');
// Route::put('categoria/{categoria}', [CategoriaController::class, 'edit'])->name('categoria.editar');

// Route::get('categoria/{categoria}/delete', [CategoriaController::class, 'delete'])->name('categoria.delete');
// Route::get('categoria', [CategoriaController::class, 'index'])->name('categoria.index');
