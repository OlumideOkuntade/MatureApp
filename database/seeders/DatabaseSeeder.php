<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Admin;
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

        Permission::firstOrCreate(["name"=>"manage_users"]);
        Permission::firstOrCreate(["name"=>"manage_customers"]);
        Permission::firstOrCreate(["name"=>"manage_products"]);
        $admin_role = Role::firstOrCreate(["name"=>"admin"]);
        $admin_role->givePermissionTo("manage_users","manage_customers","manage_products");
        $admin = User::firstOrcreate([
            "email"=> "olu@gmail.com",
            "password"=> bcrypt('1234'),
            "role"=> "admin",
            "verified_at"=> now(),
        ]);
        Admin::firstOrcreate([
            "user_id"=>$admin->id,
            "user_group_id"=> 1,
            "first_name"=>"Olumide",
            "last_name"=>"Ayomide",
            "phone_number"=> "08167657811"
        ]);
        $admin->assignRole($admin_role);
        

    }
}
