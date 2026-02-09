@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-secondary">Input Data Baru</h4>
            <a href="{{ route('form.index') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
        </div>

        <div class="card card-custom p-4 bg-white">
            <form action="{{ route('form.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" required placeholder="Nama Penanggung Jawab">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Instansi / Unit Kerja</label>
                        <input type="text" name="instansi" class="form-control" required placeholder="Asal Instansi">
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tanggal Kegiatan</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold">Keterangan Tambahan</label>
                        <textarea name="keterangan" class="form-control" rows="3" placeholder="Detail keterangan (opsional)"></textarea>
                    </div>

                    <div class="col-12 text-end mt-4">
                        <button type="submit" class="btn btn-primary-custom px-4 py-2">Simpan Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection