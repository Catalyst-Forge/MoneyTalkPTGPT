<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\CashOut;

class CashOutTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = [
            ['date' => '2024-01-02', 'description' => 'ONGKIR PENJ YEDI HIDAYAT', 'category_id' => 4, 'notes' => 'Biaya pengiriman penjualan', 'amount' => 48000],
            ['date' => '2024-01-02', 'description' => 'ONGKIR PENJ TELEMEDIA', 'category_id' => 4, 'notes' => 'Biaya pengiriman penjualan', 'amount' => 130000],
            ['date' => '2024-01-02', 'description' => 'ONGKIR PENJ ARIF PURWAKARTA', 'category_id' => 4, 'notes' => 'Biaya pengiriman penjualan', 'amount' => 30000],
            ['date' => '2024-01-02', 'description' => 'ONGKIR PENJ PAK IPIN', 'category_id' => 4, 'notes' => 'Biaya pengiriman penjualan', 'amount' => 20000],
            ['date' => '2024-01-02', 'description' => 'PEMBELIAN BENSIN MOTOR', 'category_id' => 6, 'notes' => 'Biaya transportasi', 'amount' => 30000],
            ['date' => '2024-01-02', 'description' => 'IURAN WARGA BULANAN', 'category_id' => 9, 'notes' => 'Biaya operasional bulanan', 'amount' => 100000],
            ['date' => '2024-01-03', 'description' => 'PEMBELIAN BENSIN MOBIL', 'category_id' => 6, 'notes' => 'Biaya transportasi', 'amount' => 200000],
            ['date' => '2024-01-03', 'description' => 'PEMBELIAN PLASTIK UK 15,24, 40, 1KG', 'category_id' => 4, 'notes' => 'Pembelian perlengkapan', 'amount' => 246500],
            ['date' => '2024-01-03', 'description' => 'REFUND PENJ TOKOPEDIA', 'category_id' => 9, 'notes' => 'INV/20240103/MPL/3659818984', 'amount' => 54000],
            ['date' => '2024-01-03', 'description' => 'ONGKIR PENJ UMUM A.N. SOFAN SOPYAN', 'category_id' => 4, 'notes' => 'Biaya pengiriman penjualan', 'amount' => 12500],
            ['date' => '2024-01-03', 'description' => 'ONGKIR PEMB DARI PT. STAR', 'category_id' => 4, 'notes' => 'Biaya pengiriman pembelian', 'amount' => 10000],
            ['date' => '2024-01-03', 'description' => 'ONGKIR PEMB DARI PT. GRAHAA MEGAH', 'category_id' => 4, 'notes' => 'Biaya pengiriman pembelian', 'amount' => 100000],

            ['date' => '2024-01-04', 'description' => 'ONGKIR PENJ AKBAR', 'category_id' => 4, 'notes' => 'Biaya pengiriman penjualan', 'amount' => 27000],
            ['date' => '2024-01-04', 'description' => 'SEWA GARASI', 'category_id' => 9, 'notes' => 'Biaya sewa bulanan', 'amount' => 400000],
            ['date' => '2024-01-04', 'description' => 'PEMBELIAN AIR GALON', 'category_id' => 9, 'notes' => 'Biaya operasional', 'amount' => 21000],
            ['date' => '2024-01-04', 'description' => 'PEMBELIAN KARDUS PACKING + PARKIR', 'category_id' => 4, 'notes' => 'Pembelian perlengkapan', 'amount' => 74500],
            ['date' => '2024-01-04', 'description' => 'ONGKIR PEMB DARI PT. MAKMUR ABADI', 'category_id' => 4, 'notes' => 'Biaya pengiriman pembelian', 'amount' => 10000],
            ['date' => '2024-01-04', 'description' => 'ONGKIR PEMB DARI PT. MAKMUR ABADI', 'category_id' => 4, 'notes' => 'Biaya pengiriman pembelian', 'amount' => 70000],

            ['date' => '2024-01-05', 'description' => 'ONGKIR PENJ YEDI HIDAYAT', 'category_id' => 4, 'notes' => 'Biaya pengiriman penjualan', 'amount' => 48000],
            ['date' => '2024-01-05', 'description' => 'KONSUMSI ANGKUT BARANG', 'category_id' => 9, 'notes' => 'Biaya operasional', 'amount' => 16000],
            ['date' => '2024-01-05', 'description' => 'ONGKIR PENJ ADE KARAWANG', 'category_id' => 4, 'notes' => 'Biaya pengiriman penjualan', 'amount' => 20000],
            ['date' => '2024-01-05', 'description' => 'ONGKIR PENJ AKBAR', 'category_id' => 4, 'notes' => 'Biaya pengiriman penjualan', 'amount' => 27000],
            ['date' => '2024-01-05', 'description' => 'ONGKIR PENJ SURYA', 'category_id' => 4, 'notes' => 'Biaya pengiriman penjualan', 'amount' => 12000],
            ['date' => '2024-01-05', 'description' => 'PARKIR KIRIMAN A.N. SURYA', 'category_id' => 6, 'notes' => 'Biaya parkir', 'amount' => 2000],
            ['date' => '2024-01-05', 'description' => 'ONGKIR PEMB DARI PT. MAKMUR ABADI', 'category_id' => 4, 'notes' => 'Biaya pengiriman pembelian', 'amount' => 10000],
            ['date' => '2024-01-05', 'description' => 'ONGKIR PEMB DARI PT. MAKMUR ABADI', 'category_id' => 4, 'notes' => 'Biaya pengiriman pembelian', 'amount' => 70000],
            ['date' => '2024-01-05', 'description' => 'REFUND PENJ TOKOPEDIA', 'category_id' => 9, 'notes' => 'INV/20240105/MPL/3663139403', 'amount' => 34000],
            ['date' => '2024-01-05', 'description' => 'KONSUMSI MEETING DIVISI MARKETING', 'category_id' => 3, 'notes' => 'Biaya marketing', 'amount' => 300000],

            ['date' => '2024-01-06', 'description' => 'ISI ANGIN BAN MOBIL', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 15000],
            ['date' => '2024-01-06', 'description' => 'ONGKIR PENJ A.N. HERI', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 20000],
            ['date' => '2024-01-06', 'description' => 'ONGKIR PENJ PAK CECEP GARUT', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 30000],
            ['date' => '2024-01-06', 'description' => 'ONGKIR PENJ DESIRE COMPUTER CCTV', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 55000],
            ['date' => '2024-01-06', 'description' => 'PEMBELIAN AIR MINUM KEMASAN', 'category_id' => 4, 'notes' => 'Biaya Konsumsi', 'amount' => 32000],
            ['date' => '2024-01-06', 'description' => 'ONGKIR PEMB PT. MAKMUR ABADI', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 40000],
            ['date' => '2024-01-06', 'description' => 'ONGKIR PEMB PT. GRAHAA MEGAH', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 60000],

            ['date' => '2024-01-08', 'description' => 'ANGGARAN PARKIR PAK ASEP', 'category_id' => 5, 'notes' => 'Biaya Parkir', 'amount' => 150000],
            ['date' => '2024-01-08', 'description' => 'U/ PAK RIDWAN (ISTRI MELAHIRKAN)', 'category_id' => 6, 'notes' => 'Bantuan Sosial', 'amount' => 500000],
            ['date' => '2024-01-08', 'description' => 'ONGKIR PENJ IGNATA', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 12000],
            ['date' => '2024-01-08', 'description' => 'ONGKIR PENJ INTERA CCTV', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 95000],
            ['date' => '2024-01-08', 'description' => 'ONGKIR BARANG SERVICE PT. MAKMUR ABADI', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 44000],
            ['date' => '2024-01-08', 'description' => 'REIMBURSE BENSIN SALES CONSULTANT TGL 02/01/24', 'category_id' => 7, 'notes' => 'Transportasi', 'amount' => 35000],
            ['date' => '2024-01-08', 'description' => 'ONGKIR PEMB PT. SUBUR RAYA', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 100000],
            ['date' => '2024-01-08', 'description' => 'ONGKIR PEMB PT. MAKMUR ABADI', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 30000],
            ['date' => '2024-01-09', 'description' => 'KONSUMSI ANGKUT BARANG', 'category_id' => 4, 'notes' => 'Biaya Konsumsi', 'amount' => 24000],
            ['date' => '2024-01-09', 'description' => 'ONGKIR PEMB PT. TPLINK', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 70800],
            ['date' => '2024-01-09', 'description' => 'ONGKIR PEMB PT. MAKMUR ABADI', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 50000],
            ['date' => '2024-01-09', 'description' => 'ONGKIR PEMB PT. GRAHAA MEGAH', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 50000],

            ['date' => '2024-01-10', 'description' => 'PEMBELIAN TINTA PRINTER 4 PCS', 'category_id' => 8, 'notes' => 'Biaya Perlengkapan Kantor', 'amount' => 200000],
            ['date' => '2024-01-10', 'description' => 'ONGKIR PENJ AKBAR', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 25000],
            ['date' => '2024-01-10', 'description' => 'PARKIR MOBIL', 'category_id' => 5, 'notes' => 'Biaya Parkir', 'amount' => 20000],
            ['date' => '2024-01-10', 'description' => 'ONGKIR PENJ PAK DODI', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 75000],
            ['date' => '2024-01-10', 'description' => 'ONGKIR PEMB PT. MITRA TEKNOLOGI', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 10000],
            ['date' => '2024-01-10', 'description' => 'PEMBELIAN KARDUS PACKING', 'category_id' => 8, 'notes' => 'Biaya Perlengkapan Kantor', 'amount' => 46000],
            ['date' => '2024-01-10', 'description' => 'ONGKIR BARANG SERVICE DARI ADVAN SERVICE CENTER', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 8000],
            ['date' => '2024-01-10', 'description' => 'PEMBELIAN KUOTA ADMIN MARKETPLACE', 'category_id' => 9, 'notes' => 'Biaya Internet', 'amount' => 121000],

            ['date' => '2024-01-11', 'description' => 'PEMBELIAN PENGHARUM KLOSET', 'category_id' => 10, 'notes' => 'Biaya Kebersihan', 'amount' => 13000],
            ['date' => '2024-01-11', 'description' => 'ONGKIR PEMB PT. SUBUR RAYA', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 10000],
            ['date' => '2024-01-11', 'description' => 'ONGKIR PEMB PT. INTEGRA MITRA', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 20000],
            ['date' => '2024-01-11', 'description' => 'REFUND PENJ TOKOPEDIA INV/20240111/MPL/3674981793', 'category_id' => 11, 'notes' => 'Pengembalian Dana', 'amount' => 23000],

            ['date' => '2024-01-12', 'description' => 'ONGKIR PENJ PAK TULUS', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 20000],
            ['date' => '2024-01-12', 'description' => 'ONGKIR PENJ PAK IWA', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 75000],
            ['date' => '2024-01-12', 'description' => 'ONGKIR PENJ ALTO', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 12000],
            ['date' => '2024-01-12', 'description' => 'PEMB BENSIN MOTOR SUPRA', 'category_id' => 7, 'notes' => 'Transportasi', 'amount' => 30000],
            ['date' => '2024-01-12', 'description' => 'PEMB BENSIN MOBIL WULING', 'category_id' => 7, 'notes' => 'Transportasi', 'amount' => 200000],
            ['date' => '2024-01-12', 'description' => 'PEMB PLASTIK 15, 24, 30, 35, 50', 'category_id' => 8, 'notes' => 'Biaya Perlengkapan Kantor', 'amount' => 454500],
            ['date' => '2024-01-12', 'description' => 'PEMB AIR MINUM', 'category_id' => 4, 'notes' => 'Biaya Konsumsi', 'amount' => 14000],
            ['date' => '2024-01-12', 'description' => 'ONGKIR PEMB PT. TPLINK', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 54000],
            ['date' => '2024-01-12', 'description' => 'ONGKIR PEMB PT. MAKMUR ABADI', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 30000],
            ['date' => '2024-01-12', 'description' => 'ONGKIR PEMB PT. GRAHAA MEGAH', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 40000],

            ['date' => '2024-01-13', 'description' => 'ONGKIR PENJ MUSLIH', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 20000],
            ['date' => '2024-01-13', 'description' => 'ONGKIR PENJ OM HARYANTO', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 20000],
            ['date' => '2024-01-13', 'description' => 'ONGKIR PEMB KEPADA PT. MAKMUR ABADI', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 40000],
            ['date' => '2024-01-13', 'description' => 'ONGKIR PENJ ARIF PURWAKARTA', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 13000],
            ['date' => '2024-01-13', 'description' => 'REIMBURSE BENSIN SALES CONSULTANT TGL 06/01/24', 'category_id' => 7, 'notes' => 'Transportasi', 'amount' => 35000],
            ['date' => '2024-01-13', 'description' => 'REIMBURSE BENSIN SALES CONSULTANT TGL 09/01/24', 'category_id' => 7, 'notes' => 'Transportasi', 'amount' => 20000],
            ['date' => '2024-01-13', 'description' => 'REIMBURSE PARKIR SALES CONSULTANT TGL 13/01/24', 'category_id' => 5, 'notes' => 'Biaya Parkir', 'amount' => 6000],

            ['date' => '2024-01-15', 'description' => 'ONGKIR PENJ RIAN', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 18000],
            ['date' => '2024-01-15', 'description' => 'ONGKIR PENJ PT. INFRA MEDIA SOLUSINDO', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 110000],
            ['date' => '2024-01-15', 'description' => 'IURAN SAMPAH BULANAN', 'category_id' => 10, 'notes' => 'Biaya Kebersihan', 'amount' => 20000],
            ['date' => '2024-01-15', 'description' => 'ONGKIR PENJ RAFLI RANCAEKEK', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 64000],
            ['date' => '2024-01-15', 'description' => 'ONGKIR PENJ A.N. RIZAL', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 20000],
            ['date' => '2024-01-15', 'description' => 'ONGKIR PENJ IMAGE CCTV CIANJUR', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 75000],
            ['date' => '2024-01-15', 'description' => 'CUCI MOBIL', 'category_id' => 5, 'notes' => 'Biaya Perawatan Kendaraan', 'amount' => 65000],
            ['date' => '2024-01-15', 'description' => 'ONGKIR PEMB KEPADA PT. GRAHAA MEGAH', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 10000],
            ['date' => '2024-01-15', 'description' => 'PEMBELIAN ATK TGL 13/01/2024', 'category_id' => 8, 'notes' => 'Biaya Perlengkapan Kantor', 'amount' => 452100],

            ['date' => '2024-01-16', 'description' => 'ONGKIR PENJ BAPAK MICHAEL', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 10000],
            ['date' => '2024-01-16', 'description' => 'ONGKIR PENJ ARIF PURWAKARTA', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 30000],
            ['date' => '2024-01-16', 'description' => 'REFUND PENJ TOKOPEDIA INV/20240116/MPL/3682801300', 'category_id' => 11, 'notes' => 'Pengembalian Dana', 'amount' => 17000],
            ['date' => '2024-01-16', 'description' => 'PEMB BENSIN MOTOR SUPRA', 'category_id' => 7, 'notes' => 'Transportasi', 'amount' => 20000],
            ['date' => '2024-01-16', 'description' => 'ONGKIR PENJ A.N. ALTO', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 10000],
            ['date' => '2024-01-16', 'description' => 'ONGKIR PEMB DARI HIKVISION SERVICE', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 10000],
            ['date' => '2024-01-16', 'description' => 'ONGKIR SERVICE PEMB DARI PT. MAKMUR ABADI', 'category_id' => 3, 'notes' => 'Biaya Operasional', 'amount' => 60000],
            ['date' => '2024-01-16', 'description' => 'PEMB AIR MINUM', 'category_id' => 4, 'notes' => 'Biaya Konsumsi', 'amount' => 14000],

            ['date' => '2024-01-17', 'description' => 'MAKAN MEETING WAREHOUSE', 'category_id' => 1, 'notes' => 'Makan', 'amount' => 298000],
            ['date' => '2024-01-17', 'description' => 'ONGKIR PENJ AKBAR', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 27000],
            ['date' => '2024-01-17', 'description' => 'ONGKIR PENJ RIKKY RAMDANI', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 75000],
            ['date' => '2024-01-17', 'description' => 'ONGKIR PENJ MERAK CCP - CIANJUR', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 75000],
            ['date' => '2024-01-17', 'description' => 'ONGKIR PENJ YEDI HIDAYAT', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 48000],
            ['date' => '2024-01-17', 'description' => 'ONGKIR BARANG SERVICE DARI MEGA BINTANG', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 11000],
            ['date' => '2024-01-17', 'description' => 'REFUND PENJ TOKOPEDIA INV/20240117/MPL/3684654490', 'category_id' => 3, 'notes' => 'Refund', 'amount' => 50000],
            ['date' => '2024-01-17', 'description' => 'ONGKIR PEMB PT. MAKMUR ABADI', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 10000],

            ['date' => '2024-01-18', 'description' => 'ONGKIR PENJ IMAGE CCTV CIANJUR', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 75000],
            ['date' => '2024-01-18', 'description' => 'TAGIHAN RAX', 'category_id' => 4, 'notes' => 'Tagihan', 'amount' => 317500],
            ['date' => '2024-01-18', 'description' => 'PEMBELIAN STICKER BRANDING', 'category_id' => 5, 'notes' => 'Perlengkapan', 'amount' => 130000],
            ['date' => '2024-01-18', 'description' => 'PEMBELIAN PERLENGKAPAN GUDANG BARU', 'category_id' => 5, 'notes' => 'Perlengkapan', 'amount' => 167500],
            ['date' => '2024-01-18', 'description' => 'PEMBELIAN AIR MINUM UNTUK GUDANG BARU', 'category_id' => 6, 'notes' => 'Konsumsi', 'amount' => 12000],
            ['date' => '2024-01-18', 'description' => 'MAKAN PEGAWAI DI GUDANG BARU', 'category_id' => 1, 'notes' => 'Makan', 'amount' => 45000],
            ['date' => '2024-01-18', 'description' => 'ONGKIR PEMB KEPADA PT. MAKMUR ABADI', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 10000],
            ['date' => '2024-01-18', 'description' => 'ONGKIR PEMB KEPADA PT. GRAHAA MEGAH', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 70000],

            ['date' => '2024-01-19', 'description' => 'PEMBELIAN MATERAI 10PCS', 'category_id' => 5, 'notes' => 'Perlengkapan', 'amount' => 100000],
            ['date' => '2024-01-19', 'description' => 'ONGKIR PENJ AL JAMI ANEL', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 20000],
            ['date' => '2024-01-19', 'description' => 'PEMBELIAN BENSIN MOTOR SUPRA', 'category_id' => 7, 'notes' => 'Transportasi', 'amount' => 20000],
            ['date' => '2024-01-19', 'description' => 'PEMBELIAN PLASTIK SAMPAH', 'category_id' => 5, 'notes' => 'Perlengkapan', 'amount' => 44000],
            ['date' => '2024-01-19', 'description' => 'ONGKIR PEMB PT. TPLINK', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 21600],
            ['date' => '2024-01-19', 'description' => 'ONGKIR PEMB PT. MAKMUR ABADI', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 10000],

            ['date' => '2024-01-20', 'description' => 'ONGKIR DOKUMEN KEPADA PA IHSAN NURDIN', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 10000],
            ['date' => '2024-01-20', 'description' => 'ONGKIR DOKUMEN KEPADA PT. BINTANG GLOBAL ABADI', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 11000],
            ['date' => '2024-01-20', 'description' => 'PEMBELIAN PLASTIK UK 40, 24, 35, TALI', 'category_id' => 5, 'notes' => 'Perlengkapan', 'amount' => 247000],
            ['date' => '2024-01-20', 'description' => 'PEMBELIAN AIR MINUM GALON @RP. 7000', 'category_id' => 6, 'notes' => 'Konsumsi', 'amount' => 14000],
            ['date' => '2024-01-20', 'description' => 'PEMBELIAN BENSIN MOBIL', 'category_id' => 7, 'notes' => 'Transportasi', 'amount' => 200000],
            ['date' => '2024-01-20', 'description' => 'ONGKIR PENJ PT. TAGLINE KREASINDO', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 50000],
            ['date' => '2024-01-20', 'description' => 'REIMBURSE BENSIN SALES CONSULTANT TGL 16/01/2024', 'category_id' => 7, 'notes' => 'Transportasi', 'amount' => 41000],
            ['date' => '2024-01-20', 'description' => 'PEMBELIAN AIR MINUM GALON DI GUDANG BARU', 'category_id' => 6, 'notes' => 'Konsumsi', 'amount' => 21500],
            ['date' => '2024-01-20', 'description' => 'ONGKIR BARANG SERVICE DARI PT. TRITUNGGAL', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 22000],
            ['date' => '2024-01-20', 'description' => 'ONGKIR INVOICE DARI AVARO', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 7000],
            ['date' => '2024-01-20', 'description' => 'MAKAN MEETING DIVISI FINANCE', 'category_id' => 1, 'notes' => 'Makan', 'amount' => 224300],

            ['date' => '2024-01-22', 'description' => 'ONGKIR PENJ ARIF PURWAKARTA', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 70000],
            ['date' => '2024-01-22', 'description' => 'JASA PEMASANGAN MEJA', 'category_id' => 5, 'notes' => 'Perlengkapan', 'amount' => 94000],
            ['date' => '2024-01-22', 'description' => 'PEMBELIAN BENSIN MOTOR', 'category_id' => 7, 'notes' => 'Transportasi', 'amount' => 15000],
            ['date' => '2024-01-22', 'description' => 'PARKIR MOBIL', 'category_id' => 7, 'notes' => 'Transportasi', 'amount' => 20000],
            ['date' => '2024-01-22', 'description' => 'ONGKIR BARANG SERVICE DARI PT. MAKMUR ABADI', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 32000],
            ['date' => '2024-01-22', 'description' => 'REIMBURSE BENSIN SALES CONSULTANT TGL 20/01/24', 'category_id' => 7, 'notes' => 'Transportasi', 'amount' => 35000],
            ['date' => '2024-01-22', 'description' => 'ONGKIR PENJ PT. KOPI INTERNATIONAL', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 73528],
            ['date' => '2024-01-22', 'description' => 'SISA ONGKIR PENJ PT. KOPI DIBELANJAKAN DI NON PPN', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 46000],
            ['date' => '2024-01-22', 'description' => 'REFUND ONGKIR PT. KOPI INTERNATIONAL', 'category_id' => 3, 'notes' => 'Refund', 'amount' => 103972],

            ['date' => '2024-01-23', 'description' => 'ONGKIR PENJ ARIF PURWAKARTA', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 70000],
            ['date' => '2024-01-23', 'description' => 'ONGKIR PEMB PT. GRAHAA MEGAH', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 20000],
            ['date' => '2024-01-23', 'description' => 'ONGKIR PEMB PT. MAKMUR ABADI', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 180000],

            ['date' => '2024-01-24', 'description' => 'PEMBUATAN SURAT IZIN USAHA (RT)', 'category_id' => 8, 'notes' => 'Administrasi', 'amount' => 100000],
            ['date' => '2024-01-24', 'description' => 'ONGKIR PENJ UMUM A.N. MANDRAT', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 31500],
            ['date' => '2024-01-24', 'description' => 'ONGKIR PENJ UMUM A.N. ELVREDO (SURABAYA)', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 337500],
            ['date' => '2024-01-24', 'description' => 'PEMBELIAN AIR KEMASAN 2 DUS', 'category_id' => 7, 'notes' => 'Kebutuhan Gudang', 'amount' => 32000],
            ['date' => '2024-01-24', 'description' => 'ONGKIR PEMB PT. TPLINK', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 23000],

            ['date' => '2024-01-25', 'description' => 'ONGKIR PENJ ARIF PURWAKARTA', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 30000],
            ['date' => '2024-01-25', 'description' => 'ONGKIR PENJ DEDEN SUBANG', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 50000],
            ['date' => '2024-01-25', 'description' => 'PEMBELIAN BENSIN MOTOR SUPRA', 'category_id' => 7, 'notes' => 'Transportasi', 'amount' => 20000],
            ['date' => '2024-01-25', 'description' => 'ONGKIR PEMB PT. MAKMUR ABADI', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 30000],

            ['date' => '2024-01-26', 'description' => 'ONGKIR PENJ PAK CECEP GARUT', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 30000],
            ['date' => '2024-01-26', 'description' => 'PEMBELIAN AIR MINUM GALON 3 @7.000', 'category_id' => 7, 'notes' => 'Kebutuhan Gudang', 'amount' => 21000],
            ['date' => '2024-01-26', 'description' => 'ONGKIR PEMB PT. PANCAJAYA', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 190000],
            ['date' => '2024-01-26', 'description' => 'ONGKIR PEMB PT. MAKMUR ABADI', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 30000],

            ['date' => '2024-01-27', 'description' => 'PEMBELIAN KEBUTUHAN GPT GUDANG KEMBAR', 'category_id' => 7, 'notes' => 'Kebutuhan Gudang', 'amount' => 759300],
            ['date' => '2024-01-27', 'description' => 'ONGKIR PENJ A.N. AKBAR', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 27000],
            ['date' => '2024-01-27', 'description' => 'ONGKIR PENJ JARVIS STORE', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 30000],
            ['date' => '2024-01-27', 'description' => 'ONGKIR BARANG SERVICE DARI PT. MAKMUR ABADI', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 34200],
            ['date' => '2024-01-27', 'description' => 'ONGKIR PENJ UMUM A.N. ANTON', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 22500],

            ['date' => '2024-01-29', 'description' => 'ONGKIR PENJ PAK IPIN', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 20000],
            ['date' => '2024-01-29', 'description' => 'ONGKIR PENJ RUMAH LED', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 11500],
            ['date' => '2024-01-29', 'description' => 'PEMBELIAN BENSIN MOBIL', 'category_id' => 7, 'notes' => 'Transportasi', 'amount' => 200000],
            ['date' => '2024-01-29', 'description' => 'ONGKIR PENJ ASEP CILEUNYI', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 100000],
            ['date' => '2024-01-29', 'description' => 'PARKIR MOBIL', 'category_id' => 7, 'notes' => 'Transportasi', 'amount' => 20000],
            ['date' => '2024-01-29', 'description' => 'ONGKIR PENJ CAHYONO - MICROTECH TEGAL', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 20000],
            ['date' => '2024-01-29', 'description' => 'ONGKIR PENJ ARIF PURWAKARTA', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 10000],

            ['date' => '2024-01-30', 'description' => 'ONGKIR PENJ ARIF PURWAKARTA', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 40000],
            ['date' => '2024-01-30', 'description' => 'ADMINISTRASI PERIZINAN USAHA DI KELURAHAN', 'category_id' => 1, 'notes' => 'Administrasi', 'amount' => 500000],
            ['date' => '2024-01-30', 'description' => 'PEMBELIAN KARDUS PACKING B(28) K(66)', 'category_id' => 7, 'notes' => 'Kebutuhan Gudang', 'amount' => 45500],
            ['date' => '2024-01-30', 'description' => 'ADMINISTRASI RT/RW', 'category_id' => 1, 'notes' => 'Administrasi', 'amount' => 200000],
            ['date' => '2024-01-30', 'description' => 'PERPANJANG KIR MOBIL WULING', 'category_id' => 7, 'notes' => 'Transportasi', 'amount' => 375000],
            ['date' => '2024-01-30', 'description' => 'ONGKIR PEMB RAK BARANG', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 100000],
            ['date' => '2024-01-30', 'description' => 'REIMBURSE BENSIN SALES CONSULTANT TGL 23/01/24', 'category_id' => 7, 'notes' => 'Transportasi', 'amount' => 20000],
            ['date' => '2024-01-30', 'description' => 'REIMBURSE BENSIN SALES CONSULTANT TGL 25/01/24', 'category_id' => 7, 'notes' => 'Transportasi', 'amount' => 35000],
            ['date' => '2024-01-30', 'description' => 'REIMBURSE BENSIN SALES CONSULTANT TGL 29/01/24', 'category_id' => 7, 'notes' => 'Transportasi', 'amount' => 35000],
            ['date' => '2024-01-30', 'description' => 'ONGKIR BARANG SERVICE DARI PT. MAKMUR ABADI', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 11000],
            ['date' => '2024-01-30', 'description' => 'PEMBELIAN ATK', 'category_id' => 7, 'notes' => 'Kebutuhan Kantor', 'amount' => 259000],

            ['date' => '2024-01-31', 'description' => 'ONGKIR PENJ ASMI', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 9000],
            ['date' => '2024-01-31', 'description' => 'ONGKIR PENJ ASEP CILEUNYI', 'category_id' => 2, 'notes' => 'Ongkir', 'amount' => 90000],
        ];

        foreach ($transactions as $transaction) {
            CashOut::create($transaction);
        }
    }
}
