<?php

namespace App\Exports;

use App\Models\Assets;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AssetsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @var int
     */
    private $totalAssets = 0;

    /**
     * @var float
     */
    private $totalValue = 0;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Mengambil data Asset dengan relasi terkait
        $assetsData = Assets::with('category')->get();

        // Menghitung total jumlah dan total nilai dari semua asset
        $this->totalAssets = $assetsData->sum('amount');
        $this->totalValue = $assetsData->sum('total');

        // Menambahkan ringkasan ke dalam data
        $assetsData->push((object)[
            'id' => null,
            'name' => 'Total Aset',
            'category' => (object)['name' => null],
            'date' => null,
            'amount' => $this->totalAssets,
            'value' => null,
            'total' => $this->totalValue,
        ]);

        return $assetsData;
    }

    /**
     * Menentukan header untuk file Excel.
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama Aset',
            'Kategori',
            'Tanggal',
            'Jumlah',
            'Nilai Satuan',
            'Total Nilai',
        ];
    }

    /**
     * Mapping data untuk setiap baris.
     */
    public function map($asset): array
    {
        return [
            $asset->id,
            $asset->name,
            optional($asset->category)->name,
            $asset->date,
            $asset->amount,
            $this->formatRupiah($asset->value),
            $this->formatRupiah($asset->total),
        ];
    }

    /**
     * Format angka menjadi format Rupiah.
     *
     * @param float|int|null $amount
     * @return string|null
     */
    private function formatRupiah($amount): ?string
    {
        if (is_null($amount)) {
            return null;
        }
        return 'Rp. ' . number_format($amount, 2, ',', '.');
    }
}
