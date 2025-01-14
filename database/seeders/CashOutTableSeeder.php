<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\CashOut;

use Faker\Factory as Faker;

class CashOutTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $startDate = Carbon::now()->subYears(3);
        $endDate = Carbon::now();

        // Sample Cash Out
        $cashOutDescriptions = ['Pembayaran Listrik', 'Pembayaran Air', 'Gaji Karyawan', 'Pembelian ATK', 'Biaya Marketing', 'Biaya Transportasi', 'Biaya Internet', 'Pembayaran Pajak', 'Biaya Maintenance', 'Biaya Sewa', 'Lain-lainnya'];

        for ($i = 0; $i < 200; $i++) {
            $date = Carbon::parse($startDate)->addDays(rand(0, $endDate->diffInDays($startDate)));
            CashOut::create([
                'date' => $date,
                'description' => $faker->randomElement($cashOutDescriptions),
                'category_id' => rand(3, 9),
                'notes' => $faker->sentence(),
                'amount' => $faker->randomFloat(2, 500000, 30000000),
            ]);
        }
    }
}
