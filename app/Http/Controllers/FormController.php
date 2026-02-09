<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda; // <--- PENTING: Memanggil Model Agenda
use Barryvdh\DomPDF\Facade\Pdf; // Library PDF

class FormController extends Controller
{
    // Halaman Rekap Data (Home) dengan Filter
    public function index(Request $request)
    {
        $query = Agenda::query();

        // Filter berdasarkan Nama
        if ($request->filled('nama')) {
            $query->where('nama', $request->nama);
        }

        // Filter berdasarkan Bulan
        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        // Filter berdasarkan Tahun
        if ($request->filled('tahun')) {
            $query->whereYear('tanggal', $request->tahun);
        }

        // Ambil data (urutkan dari yang terbaru)
        $data = $query->orderBy('tanggal', 'asc')->paginate(10);

        // Ambil daftar nama unik untuk dropdown filter
        $listNama = Agenda::select('nama')->distinct()->pluck('nama');

        return view('form.index', compact('data', 'listNama'));
    }

    // Halaman Form Input
    public function create()
    {
        return view('form.create');
    }

    // Proses Simpan Data ke Database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'            => 'required|string|max:255',
            'jabatan_staf'    => 'nullable|string|max:255',
            'bidang'          => 'nullable|string|max:255',
            'instansi'        => 'required|string|max:255',
            'tanggal'         => 'required|date',
            'keterangan'      => 'nullable|string',
            'judul_laporan'   => 'nullable|string|max:255', // New
            
            // Atasan
            'nama_atasan'     => 'nullable|string|max:255',
            'nip_atasan'      => 'nullable|string|max:255',
            'jabatan_atasan'  => 'nullable|string|max:255',
        ]);

        $validated['keperluan']   = '-'; 
        $validated['judul_laporan'] = $request->judul_laporan ?: 'TENAGA PENUNJANG KEGIATAN (TPK)';

        Agenda::create($validated);

        return redirect()->route('form.index')
                        ->with('success', 'Data berhasil disimpan.');
    }

    // Fitur Export PDF
    public function exportPdf(Request $request)
    {
        // Set locale ke Indonesia untuk format tanggal (Senin, Selasa, dst)
        \Carbon\Carbon::setLocale('id');

        $query = Agenda::query();

        // CHECKBOX EXPORT: If specific IDs are selected, override filters for data fetching
        if ($request->filled('selected_ids')) {
            $ids = explode(',', $request->selected_ids);
            // Re-query with specific IDs, maintaining date order
            $data = Agenda::whereIn('id', $ids)->orderBy('tanggal', 'asc')->get();
        } else {
            // Standard Filter Logic
            if ($request->filled('nama')) {
                $query->where('nama', $request->nama);
            }
            if ($request->filled('bulan')) {
                $query->whereMonth('tanggal', $request->bulan);
            }
            if ($request->filled('tahun')) {
                $query->whereYear('tanggal', $request->tahun);
            }
            $data = $query->orderBy('tanggal', 'asc')->get();
        }

        if ($data->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data untuk diexport.');
        }

        // Group data by Year-Month to separate pages
        $grouped = $data->groupBy(function($item) {
            return \Carbon\Carbon::parse($item->tanggal)->format('Y-m');
        });

        // Sort groups by key (Year-Month) ascending
        $grouped = $grouped->sortKeys();

        $reports = [];

        foreach ($grouped as $key => $items) {
            $firstItem = $items->first();
            $dateObj = \Carbon\Carbon::createFromFormat('Y-m', $key);
            
            // Signature Date: Latest date in THIS group
            $lastDate = $items->max('tanggal');
            $dateForSignature = \Carbon\Carbon::parse($lastDate);

            $meta = [
                'filter_nama'     => $firstItem->nama ?? '-',
                'filter_bulan'    => $dateObj->month,
                'filter_tahun'    => $dateObj->year,
                // Custom Title from Data
                'judul_laporan'   => $firstItem->judul_laporan ?? 'TENAGA PENUNJANG KEGIATAN (TPK)',
                
                // Ambil detail tanda tangan dari record pertama grup ini
                'jabatan_staf'    => $firstItem->jabatan_staf ?? '-',
                'bidang'          => $firstItem->bidang ?? '-',
                'nama_atasan'     => $firstItem->nama_atasan ?? '-',
                'nip_atasan'      => $firstItem->nip_atasan ?? '-',
                'jabatan_atasan'  => $firstItem->jabatan_atasan ?? '-',
                'tanggal_tanda_tangan' => $dateForSignature, 
            ];

            $reports[] = [
                'meta' => $meta,
                'data' => $items
            ];
        }
        
        $pdf = Pdf::loadView('form.pdf', compact('reports'));
        
        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan-Agenda.pdf');
    }

    // Fitur Edit
    public function edit($id)
    {
        $item = Agenda::findOrFail($id);
        return view('form.edit', compact('item'));
    }

    // Fitur Update
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama'            => 'required|string|max:255',
            'jabatan_staf'    => 'nullable|string|max:255',
            'bidang'          => 'nullable|string|max:255',
            'instansi'        => 'required|string|max:255',
            'tanggal'         => 'required|date',
            'keterangan'      => 'nullable|string',
            'judul_laporan'   => 'nullable|string|max:255',
            
            // Atasan
            'nama_atasan'     => 'nullable|string|max:255',
            'nip_atasan'      => 'nullable|string|max:255',
            'jabatan_atasan'  => 'nullable|string|max:255',
        ]);

        $validated['keperluan']   = '-'; // Maintain for DB compatibility
        $validated['judul_laporan'] = $request->judul_laporan ?: 'TENAGA PENUNJANG KEGIATAN (TPK)';

        $item = Agenda::findOrFail($id);
        $item->update($validated);

        return redirect()->route('form.index')->with('success', 'Data berhasil diperbarui.');
    }

    // Fitur Hapus
    public function destroy($id)
    {
        $item = Agenda::findOrFail($id);
        $item->delete();

        return redirect()->route('form.index')->with('success', 'Data berhasil dihapus.');
    }
}