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



        //Premium User + Role
        $user = User::create([
            'name' => "Premium",
            'email' => 'premium@rackites.com',
            'password' => bcrypt('12345678')
        ]);
        $role = Role::create([
            'name' => 'Premium'
        ]);
        $role->syncPermissions([3, 4, 5, 6, 7, 8]);
        $user->assignRole([$role->id]);

        //User + User Role
        $user = User::create([
            'name' => "User",
            'email' => 'user@rackites.com',
            'password' => bcrypt('12345678')
        ]);
        $role = Role::create([
            'name' => 'User'
        ]);
        $role->syncPermissions([5, 6, 7, 8]);
        $user->assignRole([$role->id]);
    }
}
