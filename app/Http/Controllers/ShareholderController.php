<?php

namespace App\Http\Controllers;

use App\Models\ShareholdingStructure;

class ShareholderController extends Controller
{
    public function index()
    {
        $shareholders = ShareholdingStructure::orderBy('percentage', 'desc')->get();
        return view('public.shareholders.index', compact('shareholders'));
    }
}
