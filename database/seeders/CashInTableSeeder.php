<?php

namespace Database\Seeders;

use App\Models\Cash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;

class CashInTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $startDate = Carbon::now()->subYears(3);
        $endDate = Carbon::now();

        // Sample Cash In
        $cashInDescriptions = ['Pendapatan Penjualan', 'Pendapatan Jasa', 'Bunga Bank', 'Pendapatan Sewa', 'Komisi Penjualan', 'Pendapatan Investasi', 'Penjualan Aset', 'Lain-lainnya'];

        for ($i = 0; $i < 200; $i++) {
            $date = Carbon::parse($startDate)->addDays(rand(0, $endDate->diffInDays($startDate)));
            Cash::create([
                'date' => $date,
                'description' => $faker->randomElement($cashInDescriptions),
                'category_id' => rand(1, 2),
                'notes' => $faker->sentence(),
                'amount' => $faker->randomFloat(2, 1000000, 50000000),
            ]);
        }
    }
}
