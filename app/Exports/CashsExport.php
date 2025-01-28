<?php

namespace App\Exports;

use App\Models\Cash;
use App\Models\CashOut;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CashsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
     * @var int
     */
    private $totalAmount = 0;

    /**
     * @var int
     */
    private $totalBalance = 0;

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
        $cashData = Cash::whereYear('date', \Carbon\Carbon::parse($this->selectedMonth)->year)
            ->whereMonth('date', \Carbon\Carbon::parse($this->selectedMonth)->month)
            ->with('category')
            ->get();

        $this->totalAmount = $cashData->sum('amount');

        $totalCash = Cash::sum('amount');
        $this->totalBalance = $totalCash;

        $cashData->push(
            (object) [
                'id' => null,
                'date' => null,
                'description' => null,
                'category' => (object) ['name' => null],
                'notes' => 'Total Kas Masuk',
                'amount' => $this->totalAmount,
            ],
        );

        $cashData->push(
            (object) [
                'id' => null,
                'date' => null,
                'description' => null,
                'category' => (object) ['name' => null],
                'notes' => 'Sisa Kas',
                'amount' => $this->totalBalance,
            ],
        );

        return $cashData;
    }

    public function headings(): array
    {
        return ['ID', 'Tanggal', 'Deskripsi', 'Kategori', 'Catatan', 'Jumlah'];
    }

    public function map($cash): array
    {
        return [$cash->id, $cash->date, $cash->description, optional($cash->category)->name, $cash->notes, $this->formatRupiah($cash->amount)];
    }

    /**
     * Format angka menjadi format Rupiah.
     *
     * @param float|int $amount
     * @return string
     */
    private function formatRupiah($amount): string
    {
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
        $sheet->getStyle('A1:F1')->applyFromArray([
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

        $sheet->getStyle('A2:F' . $sheet->getHighestRow())->applyFromArray([
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

        $sheet->mergeCells('A' . ($sheet->getHighestRow() - 1) . ':D' . ($sheet->getHighestRow() - 1));
        $sheet->mergeCells('A' . $sheet->getHighestRow() . ':D' . $sheet->getHighestRow());

        $sheet->getStyle('A' . ($sheet->getHighestRow() - 1) . ':D' . ($sheet->getHighestRow() - 1))->applyFromArray([
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
            ],
            'font' => [
                'bold' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        $sheet->getStyle('A' . $sheet->getHighestRow() . ':D' . $sheet->getHighestRow())->applyFromArray([
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
            ],
            'font' => [
                'bold' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        foreach (range('A', 'F') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        return [];
    }
}
