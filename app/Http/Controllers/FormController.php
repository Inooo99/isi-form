<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda; // <--- PENTING: Memanggil Model Agenda
use Barryvdh\DomPDF\Facade\Pdf; // Library PDF

class FormController extends Controller
{
    // Halaman Rekap Data (Home)
    public function index()
    {
        // Mengambil data terbaru (descending)
        $data = Agenda::latest()->get(); 
        return view('form.index', compact('data'));
    }

    // Halaman Form Input
    public function create()
    {
        return view('form.create');
    }

    // Proses Simpan Data ke Database
    public function store(Request $request)
    {
        // Validasi Input
        $validated = $request->validate([
            'nama'       => 'required|string|max:255',
            'instansi'   => 'required|string|max:255',
            'tanggal'    => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        // Simpan ke Database
        Agenda::create($validated);

        return redirect()->route('form.index')
                         ->with('success', 'Data berhasil disimpan.');
    }

    // Fitur Export PDF
    public function exportPdf()
    {
        $data = Agenda::all();
        
        // Load view khusus PDF dan kirim datanya
        $pdf = Pdf::loadView('form.pdf', compact('data'));
        
        // Set ukuran kertas (A4 Landscape)
        $pdf->setPaper('a4', 'landscape');

        // Download file
        return $pdf->download('laporan-agenda.pdf');
    }
}