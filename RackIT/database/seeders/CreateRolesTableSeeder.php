<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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


        //Premium
        $role = Role::create([
            'name' => 'Premium'
        ]);

        //User
        
        //Premium + User
        $user = User::create([
            'name' => "User",
            'email' => 'user@rackites.com',
            'password' => bcrypt('12345678')
            ]);
        $role = Role::create([
            'name' => 'User'
        ]);
        $role->syncPermissions([5,6,7,8]);
        $user->assignRole([$role->id]);
    }
}
