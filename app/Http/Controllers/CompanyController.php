<?php

namespace App\Http\Controllers;

use App\Models\BoardDirector;
use App\Models\ManagementTeam;

class CompanyController extends Controller
{
    public function profile()
    {
        return view('public.company.profile');
    }

    public function boardOfDirectors()
    {
        $directors = BoardDirector::orderBy('display_order')->get();
        return view('public.company.board', compact('directors'));
    }

    public function managementTeam()
    {
        $team = ManagementTeam::orderBy('display_order')->get();
        return view('public.company.management', compact('team'));
    }
}
