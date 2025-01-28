<?php

namespace App\Http\Controllers\admin;

use App\Exports\AssetsExport;
use App\Http\Controllers\Controller;
use App\Models\Assets;
use App\Models\Cash;
use App\Models\CashOut;
use App\Models\Category;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AssetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assets = Assets::with('category', 'cash_out', 'cash_in')->get();
        $categories = Category::all();
        $expenditure = $assets->sum('total');

        return view('admin.assets.index', compact('assets', 'categories', 'expenditure'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'cash_out_id' => 'nullable|exists:cash_outs,id',
            'cash_in_id' => 'nullable|exists:cashs,id',
            'category_id' => 'nullable|exists:categories,id',
            'date' => 'required|date',
            'amount' => 'required|integer',
            'value' => 'required|numeric',
            'total' => 'numeric',
        ]);
        $total = $request->amount * $request->value;

        Assets::create([
            'name' => $request->name,
            'cash_out_id' => $request->cash_out_id,
            'cash_in_id' => $request->cash_in_id,
            'category_id' => $request->category_id,
            'date' => $request->date,
            'amount' => $request->amount,
            'value' => $request->value,
            'total' => $total, // Hasil perhitungan total
        ]);

        return redirect()->route('asset.index')->with('success', 'Asset added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'cash_out_id' => 'nullable|exists:cash_outs,id',
            'cash_in_id' => 'nullable|exists:cashs,id',
            'category_id' => 'nullable|exists:categories,id',
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'value' => 'required|numeric',
        ]);

        Assets::findOrFail($id)->update($request->all());

        return redirect()->route('asset.index')->with('success', 'Asset successfully changed');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Assets::findOrFail($id)->delete();

        return redirect()->route('asset.index')->with('success', 'Asset deleted successfully');
    }

    public function exportExcel(Request $request)
    {
        $selectedMonth = $request->input('month');
        
        return Excel::download(new AssetsExport($selectedMonth), 'Asset_Data_' . \Carbon\Carbon::parse($selectedMonth)->translatedFormat('F_Y') . '.xlsx');
    }

    public function exportPDF(Request $request)
    {
        $month = $request->input('month');

        if ($month) {
            $assets = Assets::whereMonth('date', '=', \Carbon\Carbon::parse($month)->month)
                ->whereYear('date', '=', \Carbon\Carbon::parse($month)->year)
                ->get();
        }

        $formattedMonthRaw = \Carbon\Carbon::parse($month)->translatedFormat('F_Y');
        $formattedMonth = \Carbon\Carbon::parse($month)->locale('id')->translatedFormat('F Y');
        $expenditure = $assets->sum('value');
        $pdf = Pdf::loadView('admin.assets.pdf', compact('assets', 'expenditure', 'formattedMonth'));
        return $pdf->download('Asset_Report_' . $formattedMonthRaw . '.pdf');
    }

    public function monthlyReport(Request $request)
    {
        $month = $request->input('month');

        if ($month) {
            $assets = Assets::with('category')
                ->whereMonth('date', '=', \Carbon\Carbon::parse($month)->month)
                ->whereYear('date', '=', \Carbon\Carbon::parse($month)->year)
                ->get();

            $totalAmount = $assets->sum('amount');
        } else {
            $assets = collect();
            $totalAmount = 0;
        }

        return view('admin.assets.monthly_report', compact('assets', 'month', 'totalAmount'));
    }

    public function diagram()
    {
    }
}
