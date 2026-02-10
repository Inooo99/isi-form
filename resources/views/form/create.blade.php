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
                    <div class="col-12">
                        <label class="form-label fw-bold">Judul Laporan</label>
                        <input type="text" name="judul_laporan" class="form-control" placeholder="" value="">
                        <small class="text-muted">Bagian ini akan muncul di judul PDF: "... KEGIATAN [JUDUL INI] TAHUN ..."</small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" required placeholder="Nama Penanggung Jawab">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Jabatan Staf</label>
                        <input type="text" name="jabatan_staf" class="form-control" placeholder="Contoh: Tenaga Operator Komputer">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Bidang</label>
                        <input type="text" name="bidang" class="form-control" placeholder="Contoh: E-Government">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Wilayah / Kegiatan</label>
                        <textarea name="instansi" class="form-control" rows="3" required placeholder="Contoh: Ruang Rapat, Survei Lapangan, dll">{{ old('instansi') }}</textarea>
                        <small class="text-muted">Isi dengan Lokasi atau Nama Kegiatan.</small>
                    </div>

                    <!-- Data Atasan -->
                    <div class="col-12 mt-3">
                        <h6 class="fw-bold text-primary">Data Atasan (Untuk Tanda Tangan)</h6>
                        <hr>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Nama Atasan</label>
                        <input type="text" name="nama_atasan" class="form-control" placeholder="Nama Kabid/Kadis">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">NIP Atasan</label>
                        <input type="text" name="nip_atasan" class="form-control" placeholder="NIP Atasan">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Jabatan Atasan</label>
                        <input type="text" name="jabatan_atasan" class="form-control" placeholder="Contoh: Kepala Bidang...">
                    </div>

                    <!-- Keperluan dihapus -->

                    <div class="col-md-12 mt-3">
                        <label class="form-label fw-bold">Tanggal Kegiatan</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3" placeholder="Detail keterangan kegiatan"></textarea>
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