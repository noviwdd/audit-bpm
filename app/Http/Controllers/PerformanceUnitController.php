<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerformanceUnitController extends Controller
{
    public function index() {
        return view('performance-unit.index');
    }
}
