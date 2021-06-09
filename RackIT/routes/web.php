<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutosController;


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

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProdutosController::class);


    // Route::resource('category', CategoriaController::class);

    // ROTAS CATEGORIAS
    Route::get('categoria/add', [CategoriaController::class, 'showcreate'])->name('categoria.inserir');
    ROute::post('categoria', [CategoriaController::class, 'create'])->name('categoria.insert');

    // Route::post('categorias', [CategoriaController::class, 'refreshlista'])->name('categoria.refresh');

    ROute::get('categoria/{categoria}/edit', [CategoriaController::class, 'showedit'])->name('categoria.edit');
    Route::put('categoria/{categoria}', [CategoriaController::class, 'edit'])->name('categoria.editar');

    ROute::get('categoria/{categoria}/delete', [CategoriaController::class, 'delete'])->name('categoria.delete');
    Route::get('categoria', [CategoriaController::class, 'index'])->name('categoria.index');


    // ROTAS PRODUTOS
    Route::get('produto/add', [ProdutosController::class, 'showcreate'])->name('produtos.inserir');
    Route::get('produto/addnovo', [ProdutosController::class, 'showcreatenovo'])->name('produtos.inserirnovo');
    ROute::post('produto', [ProdutosController::class, 'create'])->name('produtos.insert');
    ROute::post('produto', [ProdutosController::class, 'createnovo'])->name('produtos.insertnovo');
    ROute::post('produtos', [ProdutosController::class, 'createInfoProd'])->name('produtos.insertInfo');
    ROute::post('produto', [ProdutosController::class, 'createInfoProdNovo'])->name('produtos.insertInfoNovo');

    ROute::get('produto/{produto}/edit', [ProdutosController::class, 'showedit'])->name('produtos.edit');
    Route::put('produto/{produto}', [ProdutosController::class, 'edit'])->name('produtos.editar');

    ROute::get('produto/{produto}/delete', [ProdutosController::class, 'delete'])->name('produtos.delete');
    Route::get('produto', [ProdutosController::class, 'index'])->name('produtos.index');
});



// Route::get('produtos', [ProdutosController::class, 'index'])->name('produtos.index');


// Route::get('categoria/add', [CategoriaController::class, 'showcreate'])->name('categoria.inserir');
// ROute::post('categoria', [CategoriaController::class, 'create'])->name('categoria.insert');

// ROute::get('categoria/{categoria}/edit', [CategoriaController::class, 'showedit'])->name('categoria.edit');
// Route::put('categoria/{categoria}', [CategoriaController::class, 'edit'])->name('categoria.editar');

// ROute::get('categoria/{categoria}/delete', [CategoriaController::class, 'delete'])->name('categoria.delete');
// Route::get('categoria', [CategoriaController::class, 'index'])->name('categoria.index');
