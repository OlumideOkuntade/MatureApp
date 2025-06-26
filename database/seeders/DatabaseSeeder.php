<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Product;
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
        Product::factory(4)->create();
        DB::table('user_groups')->insert([
            ['name' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cashier', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Store Manager', 'created_at' => now(), 'updated_at' => now()],
        ]);

    }
}
