@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10 col-md-11">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark">Rekapitulasi Data</h3>
                <p class="text-muted mb-0">Arsip data agenda kegiatan instansi.</p>
            </div>
            <a href="{{ route('form.create') }}" class="btn btn-primary shadow-sm">+ Input Baru</a>
        </div>

        <!-- Filter & Export Card -->
        <div class="card card-custom mb-4 shadow-sm border-0">
            <div class="card-body bg-light rounded">
                <form action="{{ route('form.index') }}" method="GET" id="filterForm">
                    <div class="row g-2 align-items-end">
                        <!-- Filter Section -->
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-uppercase text-muted">Bulan</label>
                            <select name="bulan" class="form-select form-select-sm">
                                <option value="">-- Semua Bulan --</option>
                                @foreach(range(1, 12) as $m)
                                    <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small fw-bold text-uppercase text-muted">Tahun</label>
                            <select name="tahun" class="form-select form-select-sm">
                                <option value="">-- Semua --</option>
                                @foreach(range(date('Y'), 2023) as $y)
                                    <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-uppercase text-muted">Nama Staf</label>
                            <select name="nama" class="form-select form-select-sm">
                                <option value="">-- Semua Nama --</option>
                                @foreach($listNama as $nm)
                                    <option value="{{ $nm }}" {{ request('nama') == $nm ? 'selected' : '' }}>{{ $nm }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 d-flex gap-2">
                            <!-- Hidden input store selected IDs -->
                            <input type="hidden" name="selected_ids" id="selected_ids">
                            
                            <button type="submit" class="btn btn-secondary btn-sm flex-grow-1" onclick="document.getElementById('filterForm').target='_self'; document.getElementById('filterForm').action='{{ route('form.index') }}'">
                                <i class="bi bi-filter"></i> Filter
                            </button>
                            <button type="submit" class="btn btn-danger btn-sm flex-grow-1" onclick="document.getElementById('filterForm').target='_blank'; document.getElementById('filterForm').action='{{ route('form.export-pdf') }}'">
                                <i class="bi bi-file-pdf"></i> Export PDF
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card card-custom shadow border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0 align-middle">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="ps-4 py-3" style="width: 5%;">No</th>
                                <th class="py-3" style="width: 15%;">Tanggal</th>
                                <th class="py-3" style="width: 20%;">Nama</th>
                                <th class="py-3" style="width: 25%;">Wilayah / Kegiatan</th>
                                <th class="py-3" style="width: 20%;">Keterangan</th>
                                <th class="py-3 text-center" style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $currentMonth = null; @endphp
                            @forelse($data as $key => $item)
                                @php
                                    $itemMonth = \Carbon\Carbon::parse($item->tanggal)->format('Y-m');
                                    $monthName = \Carbon\Carbon::parse($item->tanggal)->translatedFormat('F Y');
                                @endphp

                                @if ($currentMonth !== $itemMonth)
                                    <!-- Month Divider / Header -->
                                    <tr class="table-info">
                                        <td colspan="6" class="fw-bold text-primary">
                                            <div class="d-flex align-items-center">
                                                <input type="checkbox" class="form-check-input me-2 border-primary" 
                                                       onclick="toggleMonth('{{ $itemMonth }}', this.checked)">
                                                <span class="ms-1">Bulan: {{ $monthName }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                    @php $currentMonth = $itemMonth; @endphp
                                @endif

                            <tr>
                                <td class="ps-4">{{ ($data->currentPage() - 1) * $data->perPage() + $key + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                                <td class="fw-bold">{{ $item->nama }}</td>
                                <td>{{ $item->instansi }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($item->keterangan, 50) ?? '-' }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <!-- Checkbox Export -->
                                        <input type="checkbox" class="form-check-input export-checkbox me-2 border-secondary" 
                                               value="{{ $item->id }}" 
                                               data-month="{{ $itemMonth }}"
                                               onchange="updateSelectedIds()" 
                                               title="Centang untuk Export PDF">
                                        
                                        <a href="{{ route('form.edit', $item->id) }}" class="btn btn-sm btn-warning text-white me-1 py-0 px-2">Edit</a>
                                        <form action="{{ route('form.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger py-0 px-2">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">Belum ada data tercatat.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Pagination Links -->
            <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                <small class="text-muted">Menampilkan {{ $data->firstItem() ?? 0 }} - {{ $data->lastItem() ?? 0 }} dari {{ $data->total() }} data</small>
                <div>
                   {{ $data->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function updateSelectedIds() {
        let checkboxes = document.querySelectorAll('.export-checkbox:checked');
        let ids = Array.from(checkboxes).map(cb => cb.value).join(',');
        document.getElementById('selected_ids').value = ids;
    }

    function toggleMonth(monthKey, isChecked) {
        let checkboxes = document.querySelectorAll(`.export-checkbox[data-month="${monthKey}"]`);
        checkboxes.forEach(cb => {
            cb.checked = isChecked;
        });
        updateSelectedIds();
    }
</script>
@endsection