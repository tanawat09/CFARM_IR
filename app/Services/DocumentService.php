<?php

namespace App\Services;

use App\Models\Document;

class DocumentService
{
    public function getAll($perPage = 15)
    {
        return Document::with(['category', 'year'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function getByCategory($categoryId, $perPage = 15)
    {
        return Document::where('category_id', $categoryId)
            ->with(['category', 'year'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function getByYear($yearId, $perPage = 15)
    {
        return Document::where('year_id', $yearId)
            ->with(['category', 'year'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function store(array $data)
    {
        return Document::create($data);
    }

    public function update(Document $doc, array $data)
    {
        $doc->update($data);
        return $doc;
    }

    public function delete(Document $doc)
    {
        return $doc->delete();
    }

    public function incrementDownload(Document $doc)
    {
        $doc->increment('downloads');
        return $doc;
    }
}
