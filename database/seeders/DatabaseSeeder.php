<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Spatie\Permission\Models\Permission;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(2)->create();
        DB::table('user_groups')->insert([
            ['name' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cashier', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Store Manager', 'created_at' => now(), 'updated_at' => now()],
        ]);

        Permission::firstOrCreate(["name"=>"manage_products",]);
        Permission::firstOrCreate(["name"=>"delete_customers",]);
        Permission::firstOrCreate(["name"=>"register"]);
        $admin_role = Role::firstOrCreate(["name"=>"admin"]);
        $user_role = Role::firstOrCreate(["name"=>"user"]);
        $admin_role->givePermissionTo("manage_products,delete_customers");
        $user_role->givePermissionTo('register');
        $user1 = User::create([
            "email"=> "omo@gmail.com",
            "password"=> bcrypt('1234'),
            "role"=> "customer",
            "verified_at"=> now(),
        ]);
        $user2 = User::create([
            "email"=> "olu@gmail.com",
            "password"=> bcrypt('1234'),
            "role"=> "admin",
            "verified_at"=> now(),
        ]);
        $user1->assignRole($user_role);
        $user2->assignRole($admin_role);

    }
}
