<?php

namespace App\Http\Controllers\backsite;

use App\Http\Controllers\Controller;
use App\Models\DataPenduduk;
use App\Models\DetailDataPenduduk;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index(){
        $totalPenduduk   = DetailDataPenduduk::count();
        $totalKK         = DataPenduduk::count();
        $totalLaki       = DetailDataPenduduk::where('jenis_kelamin', 1)->count();
        $totalPerempuan  = DetailDataPenduduk::where('jenis_kelamin', 2)->count();
        return view('pages.backsite.dashboard.index', compact('totalPenduduk','totalKK', 'totalLaki', 'totalPerempuan'));
    }
}
