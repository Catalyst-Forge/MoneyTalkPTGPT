<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(CashInTableSeeder::class);
        $this->call(CashOutTableSeeder::class);
        $this->call(AssetsTableSeeder::class);
    }
}
