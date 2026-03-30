<?php

namespace App\Http\Controllers;

use App\Services\FinancialService;
use App\Models\FinancialCategory;
use App\Models\DocumentYear;
use Illuminate\Http\Request;

class FinancialController extends Controller
{
    public function __construct(protected FinancialService $financialService) {}

    public function index(Request $request)
    {
        $categories = FinancialCategory::all();
        $years = DocumentYear::orderBy('year', 'desc')->get();
        $categoryId = $request->query('category');
        $yearId = $request->query('year');

        if ($categoryId) {
            $reports = $this->financialService->getByCategory($categoryId);
        } elseif ($yearId) {
            $reports = $this->financialService->getByYear($yearId);
        } else {
            $reports = $this->financialService->getAll();
        }

        return view('public.financial.index', compact('reports', 'categories', 'years', 'categoryId', 'yearId'));
    }
}
