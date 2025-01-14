<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Assets;
use App\Models\Cash;
use App\Models\CashOut;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalCashIn = Cash::sum('amount');
        $totalCashOut = CashOut::sum('amount');
        $totalBalance = $totalCashIn - $totalCashOut;

        $cashInData = Cash::selectRaw('DATE(date) as date, SUM(amount) as total')->groupBy('date')->pluck('total', 'date');
        $cashOutData = CashOut::selectRaw('DATE(date) as date, SUM(amount) as total')->groupBy('date')->pluck('total', 'date');
        $assetData = Assets::select('name', 'total')->get();
        $cashInCategoryData = Cash::selectRaw('category_id, SUM(amount) as total')->groupBy('category_id')->pluck('total', 'category_id');
        $cashOutCategoryData = CashOut::selectRaw('category_id, SUM(amount) as total')->groupBy('category_id')->pluck('total', 'category_id');

        return view('admin.dashboard', compact('totalCashIn', 'totalCashOut', 'totalBalance', 'cashInData', 'cashOutData', 'assetData', 'cashInCategoryData', 'cashOutCategoryData'));
    }
}
