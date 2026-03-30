<?php

namespace App\Http\Controllers;

use App\Models\GovernanceDocument;

class GovernanceController extends Controller
{
    public function index()
    {
        $documents = GovernanceDocument::orderBy('effective_date', 'desc')->get();
        return view('public.governance.index', compact('documents'));
    }
}
