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
        // Categories seeding with types
        $categories = [
            [
                'name' => 'Pendapatan Operasional',
                'type' => 'cash_in',
            ],
            [
                'name' => 'Pendapatan Non-Operasional',
                'type' => 'cash_in',
            ],
            [
                'name' => 'Biaya Operasional',
                'type' => 'cash_out',
            ],
            [
                'name' => 'Biaya Administrasi',
                'type' => 'cash_out',
            ],
            [
                'name' => 'Gaji & Tunjangan Karyawan',
                'type' => 'cash_out',
            ],
            [
                'name' => 'Aset & Inventaris',
                'type' => 'asset',
            ],
            [
                'name' => 'Investasi',
                'type' => 'asset',
            ],
            [
                'name' => 'Hutang & Cicilan',
                'type' => 'cash_out',
            ],
            [
                'name' => 'Pajak',
                'type' => 'cash_out',
            ],
            [
                'name' => 'Penjualanan',
                'type' => 'cash_in',
            ],
            [
                'name' => 'Lain-lain',
                'type' => 'cash_out',
            ],
            [
                'name' => 'Lain-lain',
                'type' => 'cash_in',
            ],
            [
                'name' => 'Lain-lain',
                'type' => 'asset',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
