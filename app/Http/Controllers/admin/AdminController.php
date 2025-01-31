<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cash;
use App\Models\CashOut;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        function getCashData($model, $selectedYear, $selectedMonth = null, $format = 'Y-m')
        {
            $dateFormat = $format === 'Y-m-d' ? 'DATE_FORMAT(date, "%Y-%m-%d")' : 'DATE_FORMAT(date, "%Y-%m")';
            
            $query = $model::selectRaw("$dateFormat as date, SUM(amount) as total")->whereYear('date', $selectedYear)->groupBy('date')->orderBy('date');

            if ($selectedMonth) {
                $query->whereMonth('date', $selectedMonth);
            }

            return $query->pluck('total', 'date')->toArray();
        }

        // Total kas masuk, keluar, dan saldo
        $totalCashIn = Cash::sum('amount');
        $totalCashOut = CashOut::sum('amount');
        $totalBalance = $totalCashIn - $totalCashOut;

        // Mengambil tahun dari kas masuk dan kas keluar
        $availableMonth = Cash::selectRaw('DATE_FORMAT(date, "%Y-%m") as month')->distinct()->union(CashOut::selectRaw('DATE_FORMAT(date, "%Y-%m") as month')->distinct())->orderBy('month')->pluck('month')->toArray();

        // Mengambil tahun sekarang atau bulan yang dipilih
        $selectedMonthYear = request('month', now()->format('Y-m'));
        [$selectedYear, $selectedMonth] = explode('-', $selectedMonthYear);

        // Data kas masuk dan keluar untuk bulan terakhir
        $lastMonth = Carbon::now()->subMonth();
        $lastMonthYear = $lastMonth->format('Y-m');
        $lastMonthName = $lastMonth->translatedFormat('F Y');

        $lastMonthCashIn = Cash::whereYear('date', $lastMonth->year)
            ->whereMonth('date', $lastMonth->month)
            ->sum('amount');
        $lastMonthCashOut = CashOut::whereYear('date', $lastMonth->year)
            ->whereMonth('date', $lastMonth->month)
            ->sum('amount');

        // Data kas masuk dan keluar perbulan (dengan fungsi dinamis)
        $cashInDataMonthly = getCashData(Cash::class, $selectedYear, $selectedMonth, 'Y-m-d');
        $cashOutDataMonthly = getCashData(CashOut::class, $selectedYear, $selectedMonth);

        // Data kas masuk dan keluar pertahun (dengan fungsi dinamis)
        $cashInDataYearly = getCashData(Cash::class, $selectedYear);
        $cashOutDataYearly = getCashData(CashOut::class, $selectedYear);

        return view('admin.dashboard', compact('availableMonth', 'selectedMonthYear', 'selectedYear', 'totalCashIn', 'totalCashOut', 'totalBalance', 'cashInDataMonthly', 'cashOutDataMonthly', 'cashInDataYearly', 'cashOutDataYearly', 'lastMonthYear', 'lastMonthName', 'lastMonthCashIn', 'lastMonthCashOut'));
    }
}
