<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FinancialReport;
use App\Models\FinancialCategory;
use App\Models\DocumentYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FinancialReportController extends Controller
{
    public function index()
    {
        $reports = FinancialReport::with(['category', 'documentYear'])->latest()->paginate(15);
        return view('admin.financial_reports.index', compact('reports'));
    }

    public function create()
    {
        $categories = FinancialCategory::all();
        $years = DocumentYear::orderBy('year', 'desc')->get();
        return view('admin.financial_reports.create', compact('categories', 'years'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:financial_categories,id',
            'year_id' => 'required|exists:document_years,id',
            'title_th' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'file_path' => 'required|file|mimes:pdf,xls,xlsx,doc,docx|max:10240',
        ]);

        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('financial_reports', 'public');
        }

        FinancialReport::create($validated);

        return redirect()->route('admin.financial-reports.index')->with('success', 'Financial Report created successfully.');
    }

    public function edit(FinancialReport $financialReport)
    {
        $categories = FinancialCategory::all();
        $years = DocumentYear::orderBy('year', 'desc')->get();
        return view('admin.financial_reports.edit', compact('financialReport', 'categories', 'years'));
    }

    public function update(Request $request, FinancialReport $financialReport)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:financial_categories,id',
            'year_id' => 'required|exists:document_years,id',
            'title_th' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'file_path' => 'nullable|file|mimes:pdf,xls,xlsx,doc,docx|max:10240',
        ]);

        if ($request->hasFile('file_path')) {
            if ($financialReport->file_path) {
                Storage::disk('public')->delete($financialReport->file_path);
            }
            $validated['file_path'] = $request->file('file_path')->store('financial_reports', 'public');
        }
        
        $financialReport->update($validated);

        return redirect()->route('admin.financial-reports.index')->with('success', 'Financial Report updated successfully.');
    }

    public function destroy(FinancialReport $financialReport)
    {
        if ($financialReport->file_path) {
            Storage::disk('public')->delete($financialReport->file_path);
        }
        $financialReport->delete();

        return redirect()->route('admin.financial-reports.index')->with('success', 'Financial Report deleted successfully.');
    }
}
