<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;

class TugasController extends Controller
{

    public function index(Request $request)
    {
        $query = Tugas::query();

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan judul
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan batas waktu
        if ($request->filled('batas_waktu')) {
            $query->whereDate('batas_waktu', $request->batas_waktu);
        }

        // Filter berdasarkan prioritas
        if ($request->filled('prioritas')) {
            $query->where('prioritas', $request->prioritas);
        }

        // Ambil data dan urutkan berdasarkan batas waktu
        $tugas = $query->orderBy('batas_waktu', 'asc')->paginate(7);

        return view('tugas.index', compact('tugas'));
    }


    public function create()
    {
        return view('tugas.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'prioritas' => 'required|in:Tinggi,Sedang,Rendah',
            'status' => 'required|in:Menunggu,Sedang Dikerjakan,Selesai,Batal',
            'batas_waktu' => 'nullable|date',
        ]);

        Tugas::create($request->all());

        return redirect()->route('tugas.index')->with('success', 'Tugas berhasil ditambah');
    }

    public function edit(Tugas $tugas)
    {
        return view('tugas.form', compact('tugas'));
    }

    public function update(Request $request, Tugas $tugas)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'prioritas' => 'required|in:Tinggi,Sedang,Rendah',
            'status' => 'required|in:Menunggu,Sedang Dikerjakan,Selesai,Batal',
            'batas_waktu' => 'nullable|date',
        ]);

        $tugas->update($request->all());

        return redirect()->route('tugas.index')->with('success', 'Tugas berhasil diupdate');
    }

    public function destroy(Tugas $tugas)
    {
        $tugas->delete();
        return redirect()->route('tugas.index')->with('success', 'Tugas berhasil dihapus');
    }



}



