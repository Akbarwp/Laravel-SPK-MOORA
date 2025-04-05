<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $title = "Dashboard";
        return view('dashboard.index', compact('title'));
    }
}
