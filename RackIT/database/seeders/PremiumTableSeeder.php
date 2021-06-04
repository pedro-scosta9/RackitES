<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PremiumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // $user = User::create([
        //     'name' => "Adminstrador",
        //     'email' => 'admin@gmail.com',
        //     'password' => bcrypt('12345678')
        // ]);
        $role = Role::create([
            'name' => 'Premium'
        ]);
        // $permissions = Permission::pluck('id', 'id')->all();
        // $role->syncPermissions();
        // $user->assignRole($role->id);
    }
}
