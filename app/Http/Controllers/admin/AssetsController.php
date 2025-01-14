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

    public function exportExcel()
    {
        return Excel::download(new AssetsExport, 'data_asset.xlsx');
    }

    public function exportPDF()
    {
        $assets = Assets::all();
        $expenditure = $assets->sum('value');
        $pdf = Pdf::loadView('admin.assets.pdf', compact('assets', 'expenditure'));
        return $pdf->download('laporan_asset.pdf');
    }

    public function monthlyReport()
    {
        //
    }
}
