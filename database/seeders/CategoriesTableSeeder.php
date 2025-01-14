<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Carbon\Carbon;
use Faker\Factory as Faker;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Categories seeding
        $categories = [
            ['name' => 'Pendapatan Operasional'],
            ['name' => 'Pendapatan Non-Operasional'],
            ['name' => 'Biaya Operasional'],
            ['name' => 'Biaya Administrasi'],
            ['name' => 'Gaji & Tunjangan Karyawan'],
            ['name' => 'Aset & Inventaris'],
            ['name' => 'Investasi'],
            ['name' => 'Hutang & Cicilan'],
            ['name' => 'Pajak'],
            ['name' => 'Lain-lain']];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
