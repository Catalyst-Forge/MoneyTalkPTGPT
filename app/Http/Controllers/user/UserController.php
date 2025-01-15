<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cash;
use App\Models\CashOut;
use App\Models\Assets;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Total kas masuk, keluar, dan saldo
        $totalCashIn = Cash::sum('amount');
        $totalCashOut = CashOut::sum('amount');
        $totalBalance = $totalCashIn - $totalCashOut;

        // Get available years from both cash in and cash out
        $availableYears = collect()
            ->concat(Cash::selectRaw('YEAR(date) as year')->distinct()->pluck('year'))
            ->concat(CashOut::selectRaw('YEAR(date) as year')->distinct()->pluck('year'))
            ->unique()
            ->sort()
            ->values();

        // Get current year or selected year
        $selectedYear = request('year', now()->year);

        // Data kas masuk per bulan untuk tahun terpilih
        $cashInData = Cash::select(DB::raw('LAST_DAY(date) as date'), DB::raw('SUM(amount) as total'))->whereYear('date', $selectedYear)->groupBy(DB::raw('LAST_DAY(date)'))->orderBy('date')->pluck('total', 'date')->toArray();

        // Data kas keluar per bulan untuk tahun terpilih
        $cashOutData = CashOut::select(DB::raw('LAST_DAY(date) as date'), DB::raw('SUM(amount) as total'))->whereYear('date', $selectedYear)->groupBy(DB::raw('LAST_DAY(date)'))->orderBy('date')->pluck('total', 'date')->toArray();

        // Data aset
        $assetData = Assets::select('name', 'total')->orderBy('total', 'desc')->get()->toArray();

        // Kategori kas masuk
        $cashInCategoryData = Cash::join('categories', 'cashs.category_id', '=', 'categories.id')->select('categories.name', DB::raw('SUM(cashs.amount) as total'))->groupBy('categories.id', 'categories.name')->pluck('total', 'name')->toArray();

        // Kategori kas keluar
        $cashOutCategoryData = CashOut::join('categories', 'cash_outs.category_id', '=', 'categories.id')->select('categories.name', DB::raw('SUM(cash_outs.amount) as total'))->groupBy('categories.id', 'categories.name')->pluck('total', 'name')->toArray();

        return view('admin.dashboard', compact('availableYears', 'selectedYear', 'totalCashIn', 'totalCashOut', 'totalBalance', 'cashInData', 'cashOutData', 'assetData', 'cashInCategoryData', 'cashOutCategoryData'));
    }
}
