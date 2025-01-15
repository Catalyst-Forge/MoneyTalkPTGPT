<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Assets;
use App\Models\Cash;
use App\Models\CashOut;
use Carbon\Carbon;
use Faker\Factory as Faker;

class AssetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                $faker = Faker::create();

        $startDate = Carbon::now()->subYears(3);
        $endDate = Carbon::now();

        // Sample Assets
        $assetNames = ['Komputer', 'Laptop', 'Printer', 'AC', 'Meja Kantor', 'Kursi Kantor', 'Kendaraan Operasional', 'Mesin Fotokopi', 'UPS', 'Proyektor'];

        // Generate regular assets
        for ($i = 0; $i < 11; $i++) {
            $value = $faker->randomFloat(2, 1000000, 100000000);
            $amount = rand(1, 10);
            $date = Carbon::parse($startDate)->addDays(rand(0, $endDate->diffInDays($startDate)));

            Assets::create([
                'name' => $faker->randomElement($assetNames),
                'cash_out_id' => null,
                'cash_in_id' => null,
                'category_id' => 6,
                'date' => $date,
                'amount' => $amount,
                'value' => $value,
                'total' => $value * $amount,
            ]);
        }

        // Link some assets to cash_out
        $cashOuts = CashOut::all();
        for ($i = 0; $i < 10; $i++) {
            $value = $faker->randomFloat(2, 1000000, 100000000);
            $amount = rand(1, 5);

            Assets::create([
                'name' => $faker->randomElement($assetNames),
                'cash_out_id' => $cashOuts->random()->id,
                'cash_in_id' => null,
                'category_id' => 6,
                'date' => $cashOuts->random()->date,
                'amount' => $amount,
                'value' => $value,
                'total' => $value * $amount,
            ]);
        }

        // Link some assets to cash_in (for sold assets)
        $cashIns = Cash::all();
        for ($i = 0; $i < 5; $i++) {
            $value = $faker->randomFloat(2, 1000000, 100000000);
            $amount = rand(1, 5);

            Assets::create([
                'name' => $faker->randomElement($assetNames),
                'cash_out_id' => null,
                'cash_in_id' => $cashIns->random()->id,
                'category_id' => 6,
                'date' => $cashIns->random()->date,
                'amount' => $amount,
                'value' => $value,
                'total' => $value * $amount,
            ]);
        }
    }
}
