<?php

namespace App\Exports;

use App\Models\Assets;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AssetsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
     * @var int
     */
    private $totalAssets = 0;

    /**
     * @var float
     */
    private $totalValue = 0;

    private $selectedMonth;

    public function __construct($selectedMonth)
    {
        $this->selectedMonth = $selectedMonth;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Mengambil data Asset dengan relasi terkait
        $assetsData = Assets::whereYear('date', \Carbon\Carbon::parse($this->selectedMonth)->year)
        ->whereMonth('date', \Carbon\Carbon::parse($this->selectedMonth)->month)
        ->with('category')->get();

        // Menghitung total jumlah dan total nilai dari semua asset
        $this->totalAssets = $assetsData->sum('amount');
        $this->totalValue = $assetsData->sum('total');

        // Menambahkan ringkasan ke dalam data
        $assetsData->push(
            (object) [
                'id' => null,
                'name' => 'Total Aset',
                'category' => (object) ['name' => null],
                'date' => null,
                'amount' => $this->totalAssets,
                'value' => null,
                'total' => $this->totalValue,
            ],
        );

        return $assetsData;
    }

    /**
     * Menentukan header untuk file Excel.
     */
    public function headings(): array
    {
        return ['ID', 'Nama Aset', 'Kategori', 'Tanggal', 'Jumlah', 'Nilai Satuan', 'Total Nilai'];
    }

    /**
     * Mapping data untuk setiap baris.
     */
    public function map($asset): array
    {
        return [$asset->id, $asset->name, optional($asset->category)->name, $asset->date, $asset->amount, $this->formatRupiah($asset->value), $this->formatRupiah($asset->total)];
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

    /**
     * Menambahkan gaya pada file excel.
     *
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'ffffffff'],
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['argb' => 'ff4caf50'],
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
            ],
        ]);

        $sheet->getStyle('A2:G' . $sheet->getHighestRow())->applyFromArray([
            'font' => [
                'size' => 12,
            ],
            'alignment' => [
                'horizontal' => 'left',
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
                
            ],
        ]);

        $sheet->getStyle('A' . $sheet->getHighestRow() . ':G' . $sheet->getHighestRow())->applyFromArray([
            'borders' => [
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        foreach (range('A', 'G') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        return [];
    }
}
