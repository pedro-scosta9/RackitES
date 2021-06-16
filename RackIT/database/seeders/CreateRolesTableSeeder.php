<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\lista_produto;
use Illuminate\Support\Facades\DB;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin User + Role
        $user = User::create([
            'name' => "Adminstrador",
            'email' => 'admin@rackites.com',
            'password' => bcrypt('12345678')
        ]);
        $role = Role::create([
            'name' => 'Admin'
        ]);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole($role->id);


        $lista = lista_produto::create([
            'nome' => "Lista " . $user->name,

        ]);
        $user_id = $user->id;
        //Criar listaprodutos
        //Guardo id da lista_produtos
        $lista_produtos_id = $lista->id;
        //Inserir dados na users_has_listaprodutos
        DB::insert('insert into users_has_listaprodutos (users_id,lista_produtos_id) values (?,?)', [$user_id, $lista_produtos_id]);


        //Criar categorias default da lista (Bebidas, Carnes, Peixes, Congelados, Cereais, Frutas e Vegetais)
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Bebidas', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Carnes', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Peixes', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Congelados', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Cereais', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Frutas', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Vegetais', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Outros', $lista_produtos_id]);

        DB::insert('INSERT INTO armazens (id, nome, descricao, imagem, lista_produtos_id, created_at, updated_at) VALUES (NULL, "Frigorifico", "Frio", "", "1", NULL, NULL)');
        DB::insert('INSERT INTO armazens (id, nome, descricao, imagem, lista_produtos_id, created_at, updated_at) VALUES (NULL, "Cozinha", "", "", ?, NULL, NULL)', [$lista_produtos_id]);
        DB::insert('INSERT INTO armazens (id, nome, descricao, imagem, lista_produtos_id, created_at, updated_at) VALUES (NULL, "Garagem", "", "", ?, NULL, NULL)', [$lista_produtos_id]);
        DB::insert('INSERT INTO armazens (id, nome, descricao, imagem, lista_produtos_id, created_at, updated_at) VALUES (NULL, "Outro", "", "", ?, NULL, NULL)', [$lista_produtos_id]);

        DB::insert('INSERT INTO produtos (id, nome, codigoBarras, lista_produtos_id, created_at, updated_at) VALUES (NULL, "Iogurte", 123, 1, "2021-06-07 17:46:23", "2021-06-07 17:46:23")');
        DB::insert('INSERT INTO produtos (id, nome, codigoBarras, lista_produtos_id, created_at, updated_at) VALUES (NULL, "Pneu", 12345642, 1, "2021-06-07 17:46:51", NULL)');
        DB::insert('INSERT INTO produtos (id, nome, codigoBarras, lista_produtos_id, created_at, updated_at) VALUES (NULL, "Bolacha", 534534, 1, "2021-06-07 18:12:51", "2021-07-04 18:12:51")');

        DB::insert('INSERT INTO info_produtos (id, dataCompra, dataValidade, precoCompra, precoNormal, produtosID, armazemID, created_at, updated_at) VALUES (NULL, "2021-06-02", "2021-06-10", 1.54, 1.99, 1, 1, NULL, NULL)');
        DB::insert('INSERT INTO info_produtos (id, dataCompra, dataValidade, precoCompra, precoNormal, produtosID, armazemID, created_at, updated_at) VALUES (NULL, "2021-05-05", "2021-05-06", 1.54, 1.99, 1, 1, NULL, NULL)');
        DB::insert('INSERT INTO info_produtos (id, dataCompra, dataValidade, precoCompra, precoNormal, produtosID, armazemID, created_at, updated_at) VALUES (NULL, "2021-05-05", "2021-05-06", 50, 75, 2, 2, NULL, NULL)');
        DB::insert('INSERT INTO info_produtos (id, dataCompra, dataValidade, precoCompra, precoNormal, produtosID, armazemID, created_at, updated_at) VALUES (NULL, "2021-05-05", "2021-05-06", 50, 75, 3, 3, NULL, NULL)');

        DB::insert('insert into produtos_has_categorias (produtos_id,categorias_id) values (1,1)');
        DB::insert('insert into produtos_has_categorias (produtos_id,categorias_id) values (2,8)');
        DB::insert('insert into produtos_has_categorias (produtos_id,categorias_id) values (3,5)');

        //Premium User + Role
        $user = User::create([
            'name' => "Premium",
            'email' => 'premium@rackites.com',
            'password' => bcrypt('12345678')
        ]);
        $role = Role::create([
            'name' => 'Premium'
        ]);

        $lista = lista_produto::create([
            'nome' => "Lista " . $user->name,

        ]);
        $user_id = $user->id;
        //Criar listaprodutos
        //Guardo id da lista_produtos
        $lista_produtos_id = $lista->id;
        //Inserir dados na users_has_listaprodutos
        DB::insert('insert into users_has_listaprodutos (users_id,lista_produtos_id) values (?,?)', [$user_id, $lista_produtos_id]);


        //Criar categorias default da lista (Bebidas, Carnes, Peixes, Congelados, Cereais, Frutas e Vegetais)
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Bebidas', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Carnes', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Peixes', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Congelados', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Cereais', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Frutas', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Vegetais', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Outros', $lista_produtos_id]);

        $role->syncPermissions([9,10,11,12,13,14,15,16,17,18,19,20]);
        $user->assignRole([$role->id]);

        DB::insert('INSERT INTO armazens (id, nome, descricao, imagem, lista_produtos_id, created_at, updated_at) VALUES (NULL, "Frigorifico", "", "", ?, NULL, NULL)', [$lista_produtos_id]);
        DB::insert('INSERT INTO armazens (id, nome, descricao, imagem, lista_produtos_id, created_at, updated_at) VALUES (NULL, "Cozinha", "", "", ?, NULL, NULL)', [$lista_produtos_id]);
        DB::insert('INSERT INTO armazens (id, nome, descricao, imagem, lista_produtos_id, created_at, updated_at) VALUES (NULL, "Garagem", "", "", ?, NULL, NULL)', [$lista_produtos_id]);
        DB::insert('INSERT INTO armazens (id, nome, descricao, imagem, lista_produtos_id, created_at, updated_at) VALUES (NULL, "Outro", "", "", ?, NULL, NULL)', [$lista_produtos_id]);

        //User + User Role
        $user = User::create([
            'name' => "User",
            'email' => 'user@rackites.com',
            'password' => bcrypt('12345678')
        ]);
        $role = Role::create([
            'name' => 'User'
        ]);

        $lista = lista_produto::create([
            'nome' => "Lista " . $user->name,

        ]);
        $user_id = $user->id;
        //Criar listaprodutos
        //Guardo id da lista_produtos
        $lista_produtos_id = $lista->id;
        //Inserir dados na users_has_listaprodutos
        DB::insert('insert into users_has_listaprodutos (users_id,lista_produtos_id) values (?,?)', [$user_id, $lista_produtos_id]);

        //Criar categorias default da lista (Bebidas, Carnes, Peixes, Congelados, Cereais, Frutas e Vegetais)
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Bebidas', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Carnes', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Peixes', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Congelados', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Cereais', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Frutas', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Vegetais', $lista_produtos_id]);
        DB::insert('insert into categorias (nome,lista_produtos_id) values (?,?)', ['Outros', $lista_produtos_id]);

        DB::insert('INSERT INTO armazens (id, nome, descricao, imagem, lista_produtos_id, created_at, updated_at) VALUES (NULL, "Frigorifico", "", "", ?, NULL, NULL)', [$lista_produtos_id]);
        DB::insert('INSERT INTO armazens (id, nome, descricao, imagem, lista_produtos_id, created_at, updated_at) VALUES (NULL, "Cozinha", "", "", ?, NULL, NULL)', [$lista_produtos_id]);
        DB::insert('INSERT INTO armazens (id, nome, descricao, imagem, lista_produtos_id, created_at, updated_at) VALUES (NULL, "Garagem", "", "", ?, NULL, NULL)', [$lista_produtos_id]);
        DB::insert('INSERT INTO armazens (id, nome, descricao, imagem, lista_produtos_id, created_at, updated_at) VALUES (NULL, "Outro", "", "", ?, NULL, NULL)', [$lista_produtos_id]);

        DB::insert('insert into users_has_listaprodutos (users_id,lista_produtos_id) values (1,2)');
        DB::insert('insert into users_has_listaprodutos (users_id,lista_produtos_id) values (1,3)');


        $role->syncPermissions([9,10,11,12,13,14,15,16]);
        $user->assignRole([$role->id]);
    }
}
