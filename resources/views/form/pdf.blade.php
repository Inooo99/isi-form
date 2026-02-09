<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Agenda</title>
    <style>
        /* Pengaturan Halaman & Font Resmi */
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            margin: 0.5cm; /* Margin tipis agar muat banyak data */
        }

        /* Styling Kop Surat */
        .kop-surat {
            width: 100%;
            border-bottom: 4px double #000; /* Garis ganda khas surat resmi */
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .kop-surat td {
            border: none;
        }
        .kop-logo {
            width: 80px;
            text-align: center;
        }
        .kop-text {
            text-align: center;
        }
        .kop-text h2 { margin: 0; font-size: 16pt; text-transform: uppercase; font-weight: bold; }
        .kop-text h3 { margin: 0; font-size: 14pt; text-transform: uppercase; font-weight: bold; }
        .kop-text p { margin: 0; font-size: 10pt; font-style: italic; }

        /* Styling Judul Laporan */
        .judul-laporan {
            text-align: center;
            font-size: 12pt;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        /* Styling Tabel Data */
        .table-data {
            width: 100%;
            border-collapse: collapse; /* Agar garis tabel menyatu */
        }
        .table-data th, .table-data td {
            border: 1px solid #000;
            padding: 6px 8px;
            vertical-align: top; /* Teks selalu di atas jika baris tinggi */
        }
        .table-data th {
            background-color: #e0e0e0; /* Warna abu muda untuk header */
            text-align: center;
            font-weight: bold;
        }
        .text-center { text-align: center; }

        /* Styling Bagian Tanda Tangan */
        .table-ttd {
            width: 100%;
            margin-top: 30px;
            border: none;
        }
        .table-ttd td {
            border: none;
            text-align: center;
        }
    </style>
</head>
<body>

    <table class="kop-surat">
        <tr>
            <td class="kop-logo">
                <div style="font-weight:bold; border:2px solid #000; padding:10px;">LOGO</div>
            </td>
            
            <td class="kop-text">
                <h2>PEMERINTAH KABUPATEN CONTOH</h2>
                <h3>DINAS KOMUNIKASI DAN INFORMATIKA</h3>
                <p>Jl. Jenderal Sudirman No. 123, Kota Contoh, Kode Pos 12345</p>
                <p>Website: www.instansi.go.id | Email: info@instansi.go.id</p>
            </td>
        </tr>
    </table>

    <div class="judul-laporan">
        LAPORAN REKAPITULASI BUKU TAMU & AGENDA
    </div>

    <table class="table-data">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="15%">Tanggal</th>
                <th width="25%">Nama / Instansi</th>
                <th width="20%">Keperluan</th>
                <th width="35%">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                <td>
                    <strong>{{ $item->nama }}</strong><br>
                    <span style="font-size: 10pt; color: #333;">Asal: {{ $item->instansi }}</span>
                </td>
                <td>{{ $item->keperluan }}</td>
                <td>{{ $item->keterangan ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center" style="padding: 20px;">
                    <em>Tidak ada data yang tersedia untuk rentang waktu ini.</em>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <table class="table-ttd">
        <tr>
            <td width="65%"></td> 
            
            <td width="35%">
                <p>Kota Contoh, {{ date('d F Y') }}</p>
                <p>Mengetahui,</p>
                <p style="font-weight: bold;">Kepala Bagian Umum</p>
                
                <br><br><br><br>
                
                <p style="text-decoration: underline; font-weight: bold;">NAMA PEJABAT, S.E., M.M.</p>
                <p>NIP. 19800101 200501 1 001</p>
            </td>
        </tr>
    </table>

</body>
</html>