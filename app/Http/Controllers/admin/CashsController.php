<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CashsExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cash;
use App\Models\CashOut;
use App\Models\Category;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class CashsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cashs = Cash::with([
            'category' => function ($query) {
                $query->where('type', 'cash_in');
            },
        ])
            ->whereHas('category', function ($query) {
                $query->where('type', 'cash_in');
            })
            ->get();

        $categories = Category::where('type', 'cash_in')->get();
        $totalBalance =
            Cash::whereHas('category', function ($query) {
                $query->where('type', 'cash_in');
            })->sum('amount') - CashOut::sum('amount');

        $totalBalanceCashIn = Cash::whereHas('category', function ($query) {
            $query->where('type', 'cash_in');
        })->sum('amount');

        return view('admin.cashs.index', compact('cashs', 'categories', 'totalBalance', 'totalBalanceCashIn'));
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
            'amount' => 'required|numeric',
        ]);

        // Verify the category is cash_in type
        $category = Category::findOrFail($request->category_id);
        if ($category->type !== 'cash_in') {
            return redirect()->back()->with('error', 'Invalid category type. Must be cash in type.');
        }

        Cash::create($request->all());

        return redirect()->route('cashs.index')->with('success', 'Cash entry created successfully.');
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

        // Verify the category is cash_in type
        $category = Category::findOrFail($request->category_id);
        if ($category->type !== 'cash_in') {
            return redirect()->back()->with('error', 'Invalid category type. Must be cash in type.');
        }

        $cash = Cash::findOrFail($id);
        $cash->update($request->all());

        return redirect()->route('cashs.index')->with('success', 'Cash entry updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cash = Cash::findOrFail($id);

        // Verify the category is cash_in type before deletion
        if ($cash->category->type !== 'cash_in') {
            return redirect()->back()->with('error', 'Invalid category type. Must be cash in type.');
        }

        $cash->delete();

        return redirect()->route('cashs.index')->with('success', 'Cash entry deleted successfully.');
    }

    public function exportExcel(Request $request)
    {
        $selectedMonth = $request->input('month');

        return Excel::download(new CashsExport($selectedMonth), 'Cash_In_Entries_' . \Carbon\Carbon::parse($selectedMonth)->translatedFormat('F_Y') . '.xlsx');
    }

    public function exportPDF(Request $request)
    {
        $month = $request->input('month');

        if ($month) {
            $cashs = Cash::with([
                'category' => function ($query) {
                    $query->where('type', 'cash_in');
                },
            ])
                ->whereHas('category', function ($query) {
                    $query->where('type', 'cash_in');
                })
                ->whereMonth('date', '=', \Carbon\Carbon::parse($month)->month)
                ->whereYear('date', '=', \Carbon\Carbon::parse($month)->year)
                ->get();
        }

        $formattedMonthRaw = \Carbon\Carbon::parse($month)->translatedFormat('F_Y');
        $formattedMonth = \Carbon\Carbon::parse($month)->locale('id')->translatedFormat('F Y');
        $totalBalanceCashIn = $cashs->sum('amount');

        $pdf = Pdf::loadView('admin.cashs.pdf', compact('cashs', 'totalBalanceCashIn', 'formattedMonth'));
        return $pdf->download('Cash_In_Report_' . $formattedMonthRaw . '.pdf');
    }

    public function monthlyReport(Request $request)
    {
        $month = $request->input('month');

        if ($month) {
            $cashs = Cash::with([
                'category' => function ($query) {
                    $query->where('type', 'cash_in');
                },
            ])
                ->whereHas('category', function ($query) {
                    $query->where('type', 'cash_in');
                })
                ->whereMonth('date', '=', \Carbon\Carbon::parse($month)->month)
                ->whereYear('date', '=', \Carbon\Carbon::parse($month)->year)
                ->get();

            $totalAmount = $cashs->sum('amount');
        } else {
            $cashs = collect();
            $totalAmount = 0;
        }

        return view('admin.cashs.monthly_report', compact('cashs', 'month', 'totalAmount'));
    }
}
