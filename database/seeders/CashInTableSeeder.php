<?php

namespace Database\Seeders;

use App\Models\Cash;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CashInTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Initial balance transaction
        Cash::create([
            'date' => '2024-01-01',  // Setting start of year for initial balance
            'description' => 'Saldo Awal',
            'category_id' => 1,  // Adjust category_id as per your categories table
            'notes' => 'Saldo awal tahun 2024',
            'amount' => 2344834,
        ]);

        // January 2024 transactions
        $transactions = [
            [
                'date' => '2024-01-08',
                'description' => 'KAS',
                'category_id' => 1,
                'notes' => 'Pemasukan kas minggu pertama',
                'amount' => 3000000,
            ],
            [
                'date' => '2024-01-13',
                'description' => 'KAS',
                'category_id' => 1,
                'notes' => 'Pemasukan kas minggu kedua',
                'amount' => 3000000,
            ],
            [
                'date' => '2024-01-20',
                'description' => 'KAS',
                'category_id' => 1,
                'notes' => 'Pemasukan kas minggu ketiga',
                'amount' => 3000000,
            ],
            [
                'date' => '2024-01-29',
                'description' => 'KAS',
                'category_id' => 1,
                'notes' => 'Pemasukan kas minggu keempat',
                'amount' => 3000000,
            ],
        ];

        foreach ($transactions as $transaction) {
            Cash::create($transaction);
        }
    }
}
