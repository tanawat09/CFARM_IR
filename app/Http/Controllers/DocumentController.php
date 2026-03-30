<?php

namespace App\Http\Controllers;

use App\Services\DocumentService;
use App\Models\DocumentCategory;
use App\Models\DocumentYear;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function __construct(protected DocumentService $documentService) {}

    public function index(Request $request)
    {
        $categories = DocumentCategory::all();
        $years = DocumentYear::orderBy('year', 'desc')->get();
        $categoryId = $request->query('category');
        $yearId = $request->query('year');

        if ($categoryId) {
            $documents = $this->documentService->getByCategory($categoryId);
        } elseif ($yearId) {
            $documents = $this->documentService->getByYear($yearId);
        } else {
            $documents = $this->documentService->getAll();
        }

        return view('public.documents.index', compact('documents', 'categories', 'years', 'categoryId', 'yearId'));
    }

    public function download(Document $document)
    {
        if ($document->external_link) {
            $this->documentService->incrementDownload($document);
            return redirect()->away($document->external_link);
        }

        abort_unless($document->file_path && str_starts_with($document->file_path, 'documents/'), 404);
        abort_unless(Storage::disk('public')->exists($document->file_path), 404);

        $this->documentService->incrementDownload($document);
        $extension = pathinfo($document->file_path, PATHINFO_EXTENSION) ?: 'pdf';
        $downloadName = $document->title_th . '.' . $extension;
        return Storage::disk('public')->download($document->file_path, $downloadName);
    }

    public function view(Document $document)
    {
        if ($document->external_link) {
            $this->documentService->incrementDownload($document);
            return redirect()->away($document->external_link);
        }

        abort_unless($document->file_path && str_starts_with($document->file_path, 'documents/'), 404);
        abort_unless(Storage::disk('public')->exists($document->file_path), 404);

        $this->documentService->incrementDownload($document);
        return redirect(asset('storage/' . $document->file_path));
    }
}
