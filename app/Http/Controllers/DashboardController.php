<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Mobil;

class DashboardController extends Controller
{
    public function index()
    {
        $mobil = Mobil::paginate(10);
        $kriteria = Kriteria::all();
        $total_bobot = Kriteria::sum('bobot');
        return view('pages.dashboard', compact('mobil','kriteria', 'total_bobot'));
    }
}
