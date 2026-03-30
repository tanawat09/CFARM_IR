<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShareholdingStructure;
use Illuminate\Http\Request;

class ShareholdingStructureController extends Controller
{
    public function index()
    {
        $shareholders = ShareholdingStructure::orderBy('percentage', 'desc')->get();
        return view('admin.shareholders.index', compact('shareholders'));
    }

    public function create()
    {
        return view('admin.shareholders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'shareholder_name_th' => 'required|string|max:255',
            'shareholder_name_en' => 'nullable|string|max:255',
            'number_of_shares' => 'required|integer|min:0',
            'percentage' => 'required|numeric|min:0|max:100',
            'as_of_date' => 'nullable|date',
        ]);

        ShareholdingStructure::create($validated);

        return redirect()->route('admin.shareholders.index')->with('success', 'Shareholder added successfully.');
    }

    public function edit(ShareholdingStructure $shareholder)
    {
        return view('admin.shareholders.edit', compact('shareholder'));
    }

    public function update(Request $request, ShareholdingStructure $shareholder)
    {
        $validated = $request->validate([
            'shareholder_name_th' => 'required|string|max:255',
            'shareholder_name_en' => 'nullable|string|max:255',
            'number_of_shares' => 'required|integer|min:0',
            'percentage' => 'required|numeric|min:0|max:100',
            'as_of_date' => 'nullable|date',
        ]);

        $shareholder->update($validated);

        return redirect()->route('admin.shareholders.index')->with('success', 'Shareholder updated successfully.');
    }

    public function destroy(ShareholdingStructure $shareholder)
    {
        $shareholder->delete();
        return redirect()->route('admin.shareholders.index')->with('success', 'Shareholder deleted successfully.');
    }
}
