<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PasienModel;
use App\Models\RumahSakitModel;

class DashboardController extends Controller
{
    public function index()
    {
        $pasien = PasienModel::count();
        $rumah_sakit = RumahSakitModel::count();
        return view('dashboard', compact('pasien', 'rumah_sakit'));
    }
}
