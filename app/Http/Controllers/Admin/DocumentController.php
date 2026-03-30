<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentCategory;
use App\Models\DocumentYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::with(['category', 'year'])->latest()->paginate(15);
        return view('admin.documents.index', compact('documents'));
    }

    public function create()
    {
        $categories = DocumentCategory::all();
        $years = DocumentYear::orderBy('year', 'desc')->get();
        return view('admin.documents.create', compact('categories', 'years'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_th' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'category_id' => 'required|exists:document_categories,id',
            'year_id' => 'nullable|exists:document_years,id',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:20480',
        ]);

        $path = $request->file('file')->store('documents', 'public');
        $validated['file_path'] = $path;

        Document::create($validated);

        return redirect()->route('admin.documents.index')->with('success', 'Document uploaded successfully.');
    }

    public function edit(Document $document)
    {
        $categories = DocumentCategory::all();
        $years = DocumentYear::orderBy('year', 'desc')->get();
        return view('admin.documents.edit', compact('document', 'categories', 'years'));
    }

    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'title_th' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'category_id' => 'required|exists:document_categories,id',
            'year_id' => 'nullable|exists:document_years,id',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:20480',
        ]);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($document->file_path);
            $validated['file_path'] = $request->file('file')->store('documents', 'public');
        }

        $document->update($validated);

        return redirect()->route('admin.documents.index')->with('success', 'Document updated successfully.');
    }

    public function destroy(Document $document)
    {
        Storage::disk('public')->delete($document->file_path);
        $document->delete();
        return redirect()->route('admin.documents.index')->with('success', 'Document deleted successfully.');
    }
}
