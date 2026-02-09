@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-secondary">Edit Data Agenda</h4>
            <a href="{{ route('form.index') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
        </div>

        <div class="card card-custom p-4 bg-white">
            <form action="{{ route('form.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label fw-bold">Judul Laporan (Jenis TPK)</label>
                        <input type="text" name="judul_laporan" class="form-control" placeholder="Default: TENAGA PENUNJANG KEGIATAN (TPK)" value="{{ old('judul_laporan', $item->judul_laporan) }}">
                        <small class="text-muted">Bagian ini akan muncul di judul PDF: "... KEGIATAN [JUDUL INI] TAHUN ..."</small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" required placeholder="Nama Penanggung Jawab" value="{{ old('nama', $item->nama) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Jabatan Staf</label>
                        <input type="text" name="jabatan_staf" class="form-control" placeholder="Contoh: Tenaga Operator Komputer" value="{{ old('jabatan_staf', $item->jabatan_staf) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Bidang</label>
                        <input type="text" name="bidang" class="form-control" placeholder="Contoh: E-Government" value="{{ old('bidang', $item->bidang) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Wilayah / Kegiatan</label>
                        <input type="text" name="instansi" class="form-control" required placeholder="Contoh: Ruang Rapat, Survei Lapangan, dll" value="{{ old('instansi', $item->instansi) }}">
                        <small class="text-muted">Isi dengan Lokasi atau Nama Kegiatan.</small>
                    </div>

                    <!-- Data Atasan -->
                    <div class="col-12 mt-3">
                        <h6 class="fw-bold text-primary">Data Atasan (Untuk Tanda Tangan)</h6>
                        <hr>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Nama Atasan</label>
                        <input type="text" name="nama_atasan" class="form-control" placeholder="Nama Kabid/Kadis" value="{{ old('nama_atasan', $item->nama_atasan) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">NIP Atasan</label>
                        <input type="text" name="nip_atasan" class="form-control" placeholder="NIP Atasan" value="{{ old('nip_atasan', $item->nip_atasan) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Jabatan Atasan</label>
                        <input type="text" name="jabatan_atasan" class="form-control" placeholder="Contoh: Kepala Bidang..." value="{{ old('jabatan_atasan', $item->jabatan_atasan) }}">
                    </div>

                    <div class="col-md-12 mt-3">
                        <label class="form-label fw-bold">Tanggal Kegiatan</label>
                        <input type="date" name="tanggal" class="form-control" required value="{{ old('tanggal', $item->tanggal) }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3" placeholder="Detail keterangan kegiatan">{{ old('keterangan', $item->keterangan) }}</textarea>
                    </div>

                    <div class="col-12 text-end mt-4">
                        <button type="submit" class="btn btn-success px-4 py-2">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection