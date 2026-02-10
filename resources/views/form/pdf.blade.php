<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Agenda Diskominfo</title>
    <style>
        @page { size: A4 landscape; margin: 1cm; }
        
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            line-height: 1.15;
            margin: 0;
            padding: 0;
        }

        /* --- KOP SURAT --- */
        .kop-container {
            width: 100%;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
            text-align: center; /* Center everything */
            display: table; /* Make it behave like a table to vertically align logo & text */
        }
        
        /* Logo & Text Wrapper to keep them close */
        .kop-content {
            display: inline-block; /* Shrink to fit content so they stay together */
            text-align: center;
            width: 100%;
        }

        .logo-img {
            width: 80px;
            height: auto;
            vertical-align: middle;
            margin-right: 15px; /* Space between logo and text */
            float: left; /* Float left to sit next to text block if needed, or use inline-block approach */
            position: absolute; /* Absolute positioning might be safer for strict centering of text */
            left: 20px;
            top: 20px;
        }

        /* Using a Table for KOP to ensure Logo is Left of Text but Content is Centered */
        .header-table {
            width: 100%;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header-table td {
            border: none;
            vertical-align: middle;
        }
        .logo-cell {
            width: 10%; /* Small width to keep logo close */
            text-align: right; /* Push logo to the right of its cell (towards text) */
            padding-right: 10px;
        }
        .text-cell {
            width: 90%;
            text-align: center;
            padding-right: 80px; /* Counter-balance the logo width to center text visually on page if needed, OR just center it in its cell */
        }
        
        /* New Approach for "Rata Tengah Semuanya" */
        /* Let's try a single cell centered or flex-like behavior with inline-block */
        .header-title-block {
            text-align: center;
        }
        .header-title-block img {
            vertical-align: middle;
            width: 80px;
            margin-right: 15px;
        }
        .header-title-block div {
            display: inline-block;
            vertical-align: middle;
            text-align: center;
        }

        /* Typography */
        .header-text h3 {
            margin: 0;
            font-size: 16pt;
            font-weight: normal; 
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }
        .header-text h2 {
            margin: 0;
            font-size: 24pt; 
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 5px;
            font-family: Arial, Helvetica, sans-serif; 
        }
        .header-text p {
            margin: 0;
            font-size: 11pt;
            line-height: 1.3;
        }
        .header-text a {
            color: #000;
            text-decoration: none;
        }

        /* --- JUDUL LAPORAN --- */
        .judul-container {
            text-align: center;
            margin-bottom: 20px;
            text-transform: uppercase;
            font-weight: bold;
            font-size: 12pt;
        }

        /* --- INFO DATA --- */
        .info-table {
            width: 100%;
            margin-bottom: 10px;
            font-weight: bold;
            font-size: 11pt;
        }
        .info-table td {
            border: none;
            padding: 2px 0;
            vertical-align: top;
        }

        /* --- TABEL DATA --- */
        .table-data {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table-data th, .table-data td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
            font-size: 11pt;
        }
        
        /* Headers: Soft Blue #bdd7ee */
        .bg-blue {
            background-color: #bdd7ee; 
        }

        /* NO Column: Distinct Cyan Blue per request (Bright Cyan) */
        .bg-cyan {
            background-color: #00bef3; /* Bright cyan similar to Reference Image 3 */
        }

        .table-data th {
            text-align: center;
            font-weight: bold;
            vertical-align: middle;
            text-transform: uppercase;
        }
        
        .center { text-align: center; }

        /* --- TANDA TANGAN --- */
        .ttd-table { width: 100%; border: none; margin-top: 40px; }
        .ttd-table td { border: none; text-align: center; vertical-align: top; }
        
        .ttd-left { width: 40%; }
        .ttd-center { width: 20%; }
        .ttd-right { width: 40%; }

    </style>
</head>
<body>

    <!-- Loop through each report group (Month/Year) -->
    @foreach($reports as $index => $report)
        @php
            $meta = $report['meta'];
            $data = $report['data'];
        @endphp

        <!-- Content Helper wrapper -->
        <div class="page-content">
            
            <!-- KOP SURAT (Revised: Center Everything) -->
            <!-- Reduced margin-bottom from 20px to 5px to make title closer -->
            <div style="border-bottom: 3px double #000; padding-bottom: 10px; margin-bottom: 5px; text-align: center;">
                <table style="width: 100%; border: none;">
                    <tr>
                        <td style="text-align: center;">
                            <div style="display: inline-block; margin-right: 15px; vertical-align: top;">
                                <img src="{{ public_path('img/logo_mataram.png') }}" style="width: 80px; height: auto;">
                            </div>
                            <div class="header-text" style="display: inline-block; vertical-align: top; text-align: center;">
                                <h3>PEMERINTAH KOTA MATARAM</h3>
                                <h2>DINAS KOMUNIKASI DAN INFORMATIKA</h2>
                                <p>Jalan H. L. Mujitahid No. 1 Lt. III Gedung Selatan Kantor Walikota Mataram</p>
                                <p>Telepon: (0370) 7504671; Posel: layanan@diskominfo.mataramkota.go.id</p>
                                <p>Laman: www.diskominfo.mataramkota.go.id</p>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- JUDUL -->
            <div class="judul-container">
                DAFTAR LAPORAN KEGIATAN {{ $meta['judul_laporan'] ?? 'TENAGA PENUNJANG KEGIATAN (TPK)' }} TAHUN {{ $meta['filter_tahun'] ?? date('Y') }}
            </div>

            <!-- INFO ATAS -->
            <table class="info-table">
                <tr>
                    <td style="width: 10%;">Nama</td>
                    <td style="width: 2%;">:</td>
                    <td style="width: 40%;">{{ $meta['filter_nama'] ? $meta['filter_nama'] : '-' }}</td>
                    
                    <!-- Spacer to push right column -->
                    <td style="width: 10%;"></td>

                    <td style="width: 10%;">Jabatan</td> <!-- Changed from Staf -->
                    <td style="width: 2%;">:</td>
                    <td style="width: 26%;">{{ $meta['jabatan_staf'] ?: '-' }}</td>
                </tr>
                <tr>
                    <td>Bulan</td>
                    <td>:</td>
                    <td>
                        @if($meta['filter_bulan'])
                            {{ \Carbon\Carbon::create()->month($meta['filter_bulan'])->translatedFormat('F') }}
                        @else
                            -
                        @endif
                    </td>

                    <td></td> <!-- Spacer -->

                    <td>Bidang</td>
                    <td>:</td>
                    <td>{{ $meta['bidang'] ?: '-' }}</td>
                </tr>
            </table>

            <!-- TABEL DATA -->
            <table class="table-data">
                <thead>
                    <tr class="bg-blue">
                        <th style="width: 5%">NO</th> 
                        <th style="width: 15%">HARI/TANGGAL</th>
                        <th style="width: 30%">WILAYAH / KEGIATAN</th>
                        <th style="width: 50%">KETERANGAN</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $key => $item)
                    <tr>
                        <td class="center bg-cyan">{{ $key + 1 }}</td>
                        <td>
                            {{-- Format: Rabu, 11 Januari 2023 --}}
                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}
                        </td>
                        <td>
                            {!! nl2br(e($item->instansi)) !!}
                        </td>
                        <td>
                            {{ $item->keterangan ?? '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="center" style="padding: 20px;">Tidak ada data agenda untuk periode ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- TANDA TANGAN -->
            <table class="ttd-table">
                <tr>
                    <!-- Kiri: Atasan -->
                    <td class="ttd-left">
                        <p>Mengetahui :</p>
                        <p><b>{{ $meta['jabatan_atasan'] ?: 'Kepala Bidang' }}</b></p>
                        <br><br><br><br>
                        <p style="text-decoration: underline; font-weight: bold;">{{ $meta['nama_atasan'] ?: '(..........................)' }}</p>
                        <p>NIP. {{ $meta['nip_atasan'] ?: '..........................' }}</p>
                    </td>

                    <td class="ttd-center"></td>

                    <!-- Kanan: Staf yang bersangkutan -->
                    <td class="ttd-right">
                        <p>Mataram, {{ $meta['tanggal_tanda_tangan']->translatedFormat('d F Y') }}</p>
                        <p><b>{{ $meta['jabatan_staf'] ?: 'Staf' }}</b></p> 
                        <br><br><br><br>
                        <!-- Name normal case, matches top info -->
                        <p style="text-decoration: underline; font-weight: bold;">{{ $meta['filter_nama'] ? $meta['filter_nama'] : '(..........................)' }}</p>
                    </td>
                </tr>
            </table>

        </div>

        <!-- Page Break if not last item -->
        @if(!$loop->last)
            <div style="page-break-after: always;"></div>
        @endif

    @endforeach

</body>
</html>