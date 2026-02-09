@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark">Rekapitulasi Data</h3>
        <p class="text-muted mb-0">Arsip data agenda kegiatan instansi.</p>
    </div>
    <div>
        <a href="{{ route('form.create') }}" class="btn btn-primary-custom me-2">+ Input Baru</a>
        <a href="{{ route('form.export-pdf') }}" class="btn btn-danger">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-pdf" viewBox="0 0 16 16">
                <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
            </svg> Export PDF
        </a>
    </div>
</div>

<div class="card card-custom">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4 py-3">No</th>
                        <th class="py-3">Tanggal</th>
                        <th class="py-3">Nama / Instansi</th>
                        <th class="py-3">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $key => $item)
                    <tr>
                        <td class="ps-4">{{ $key + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                        <td>
                            <div class="fw-bold">{{ $item->nama }}</div>
                            <small class="text-muted">{{ $item->instansi }}</small>
                        </td>
                        <td>{{ $item->keterangan ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">Belum ada data tercatat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection