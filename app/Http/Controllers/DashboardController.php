<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTugas = Tugas::count();
        $selesai = Tugas::where('status', 'Selesai')->count();
        $sedang = Tugas::where('status', 'Sedang Dikerjakan')->count();
        $menunggu = Tugas::where('status', 'Menunggu')->count();

        $tugasTerbaru = Tugas::latest()->take(5)->get();

        return view('dashboard', compact('totalTugas', 'selesai', 'sedang', 'menunggu', 'tugasTerbaru'));
    }
}
