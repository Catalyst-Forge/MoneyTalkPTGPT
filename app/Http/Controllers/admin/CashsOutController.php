<?php

namespace App\Http\Controllers\admin;

use App\Exports\CashsOutExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CashOut;
use App\Models\Cash;
use App\Models\Category;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class CashsOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cashOuts = CashOut::with([
            'category' => function ($query) {
                $query->where('type', 'cash_out');
            },
        ])
            ->whereHas('category', function ($query) {
                $query->where('type', 'cash_out');
            })
            ->get();

        $categories = Category::where('type', 'cash_out')->get();

        $totalBalance =
            Cash::whereHas('category', function ($query) {
                $query->where('type', 'cash_in');
            })->sum('amount') -
            CashOut::whereHas('category', function ($query) {
                $query->where('type', 'cash_out');
            })->sum('amount');

        $totalBalanceCashOut = CashOut::whereHas('category', function ($query) {
            $query->where('type', 'cash_out');
        })->sum('amount');

        return view('admin.cashs-out.index', compact('cashOuts', 'totalBalance', 'categories', 'totalBalanceCashOut'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'description' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'notes' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
        ]);

        // Verify the category is cash_out type
        $category = Category::findOrFail($request->category_id);
        if ($category->type !== 'cash_out') {
            return redirect()->back()->with('error', 'Invalid category type. Must be cash out type.');
        }

        CashOut::create($request->all());

        return redirect()->route('cashs-out.index')->with('success', 'Cash out entry created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'date' => 'required|date',
            'description' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'notes' => 'nullable|string',
            'amount' => 'required|numeric',
        ]);

        // Verify the category is cash_out type
        $category = Category::findOrFail($request->category_id);
        if ($category->type !== 'cash_out') {
            return redirect()->back()->with('error', 'Invalid category type. Must be cash out type.');
        }

        $cash = CashOut::findOrFail($id);
        $cash->update($request->all());

        return redirect()->route('cashs-out.index')->with('success', 'Cash out entry updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cash = CashOut::findOrFail($id);

        // Verify the category is cash_out type before deletion
        if ($cash->category->type !== 'cash_out') {
            return redirect()->back()->with('error', 'Invalid category type. Must be cash out type.');
        }

        $cash->delete();

        return redirect()->route('cashs-out.index')->with('success', 'Cash out entry deleted successfully.');
    }

    public function exportExcel(Request $request)
    {
        $selectedMonth = $request->input('month');

        return Excel::download(new CashsOutExport($selectedMonth), 'Cash_Out_Entries_' . \Carbon\Carbon::parse($selectedMonth)->translatedFormat('F_Y') . '.xlsx');
    }

    public function exportPDF(Request $request)
    {
        $month = $request->input('month');

        if ($month) {
            $cashs_out = CashOut::with([
                'category' => function ($query) {
                    $query->where('type', 'cash_out');
                },
            ])
                ->whereHas('category', function ($query) {
                    $query->where('type', 'cash_out');
                })
                ->whereMonth('date', '=', \Carbon\Carbon::parse($month)->month)
                ->whereYear('date', '=', \Carbon\Carbon::parse($month)->year)
                ->get();
        }

        $formattedMonthRaw = \Carbon\Carbon::parse($month)->translatedFormat('F_Y');
        $formattedMonth = \Carbon\Carbon::parse($month)->locale('id')->translatedFormat('F Y');
        $totalBalanceCashOut = $cashs_out->sum('amount');

        $pdf = Pdf::loadView('admin.cashs-out.pdf', compact('cashs_out', 'totalBalanceCashOut', 'formattedMonth'));
        return $pdf->download('Cash_Out_Report_' . $formattedMonthRaw . '.pdf');
    }

    public function monthlyReport(Request $request)
    {
        $month = $request->input('month');

        if ($month) {
            $cashOuts = CashOut::with([
                'category' => function ($query) {
                    $query->where('type', 'cash_out');
                },
            ])
                ->whereHas('category', function ($query) {
                    $query->where('type', 'cash_out');
                })
                ->whereMonth('date', '=', \Carbon\Carbon::parse($month)->month)
                ->whereYear('date', '=', \Carbon\Carbon::parse($month)->year)
                ->get();

            $totalAmount = $cashOuts->sum('amount');
        } else {
            $cashOuts = collect();
            $totalAmount = 0;
        }

        return view('admin.cashs-out.monthly_report', compact('cashOuts', 'month', 'totalAmount'));
    }
}
