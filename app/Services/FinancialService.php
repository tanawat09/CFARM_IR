<?php

namespace App\Services;

use App\Models\FinancialReport;

class FinancialService
{
    public function getAll($perPage = 15)
    {
        return FinancialReport::with(['category', 'year'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function getByCategory($categoryId, $perPage = 15)
    {
        return FinancialReport::where('category_id', $categoryId)
            ->with(['category', 'year'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function getByYear($yearId, $perPage = 15)
    {
        return FinancialReport::where('year_id', $yearId)
            ->with(['category', 'year'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function store(array $data)
    {
        return FinancialReport::create($data);
    }

    public function update(FinancialReport $report, array $data)
    {
        $report->update($data);
        return $report;
    }

    public function delete(FinancialReport $report)
    {
        return $report->delete();
    }
}
