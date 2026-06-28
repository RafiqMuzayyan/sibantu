<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>{{ $judul }}</title>
    <style>
        @page {
            margin: 20px;
        }
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #1a1a1a;
            font-size: 11.5px;
            line-height: 1.6;
            background: #fff;
            padding: 32px 40px;
        }

        /* ── HEADER ── */
        .header {
            display: table;
            width: 100%;
            border-bottom: 2.5px solid #0f766e;;
            padding-bottom: 14px;
            margin-bottom: 28px;
        }

        .header-left {
            display: table-cell;
            vertical-align: middle;
        }

        .header-right {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
        }

        .logo {
            width: 46px;
        }

        .brand {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }

        .green { color: #0f766e;; }

        .header-meta {
            font-size: 10px;
            color: #6b7280;
            margin-top: 2px;
        }

        /* ── TITLE BLOCK ── */
        .title {
            text-align: center;
            margin: 0 0 28px;
            padding: 18px 0;
            background: #f0fdf4;
            border-radius: 6px;
        }

        .title h1 {
            font-size: 17px;
            font-weight: bold;
            letter-spacing: 0.5px;
            color: #14532d;
        }

        .title p {
            color: #6b7280;
            margin-top: 4px;
            font-size: 10.5px;
        }

        /* ── SECTION TITLE ── */
        .section-title {
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #0f766e;;
            border-bottom: 1px solid #d1fae5;
            padding-bottom: 5px;
            margin: 24px 0 10px;
        }

        /* ── INFO TABLE ── */
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table tr {
            border-bottom: 1px solid #f3f4f6;
        }

        .info-table td {
            padding: 6px 4px;
            vertical-align: top;
        }

        .label {
            width: 130px;
            font-weight: bold;
            color: #374151;
        }

        .info-table td:nth-child(2) {
            color: #4b5563;
        }

        /* ── STATS ── */
        .stats {
            width: 100%;
            border-collapse: separate;
            border-spacing: 6px 0;
            margin-top: 4px;
        }

        .stats td {
            width: 20%;
            border: 1px solid #e5e7eb;
            text-align: center;
            padding: 12px 8px;
            border-radius: 6px;
            background: #fafafa;
        }

        .stats td:first-child {
            background: #f0fdf4;
            border-color: #bbf7d0;
        }

        .stats-title {
            color: #6b7280;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .stats-value {
            font-size: 22px;
            font-weight: bold;
            color: #111827;
            margin-top: 4px;
            line-height: 1;
        }

        .stats td:first-child .stats-value {
            color: #0f766e;;
        }

        /* ── ADUAN TABLE ── */
        .aduan-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
            font-size: 11px;
        }

        .aduan-table th {
            background: #06b9aa;;
            color: #fff !important;
            padding: 9px 10px;
            text-align: left;
            font-weight: bold;
            font-size: 10.5px;
            letter-spacing: 0.2px;
        }
        
        .aduan-table th:first-child { border-radius: 4px 0 0 0; }
        .aduan-table th:last-child  { border-radius: 0 4px 0 0; }

        .aduan-table td {
            border-bottom: 1px solid #e5e7eb;
            border-left: 1px solid #f3f4f6;
            border-right: 1px solid #f3f4f6;
            padding: 7px 10px;
            color: #374151;
            vertical-align: top;
        }

        .aduan-table td:first-child {
            color: #9ca3af;
            font-size: 10px;
            text-align: center;
        }

        .aduan-table tr:nth-child(even) td {
            background: #f9fafb;
        }

        .aduan-table tbody tr:last-child td:first-child  { border-radius: 0 0 0 4px; }
        .aduan-table tbody tr:last-child td:last-child   { border-radius: 0 0 4px 0; }

        /* ── FOOTER ── */
        .footer {
            margin-top: 36px;
            padding-top: 10px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            color: #9ca3af;
            font-size: 9.5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-left">
            <table>
                <tr>
                    <td width="45">
                        <img
                            src="{{ public_path('img/icon.png') }}"
                            class="logo"
                        >
                    </td>
                    <td>
                        <div class="brand">
                            Si<span class="green">Bantu</span>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="header-right">
            <div class="header-meta">Sistem Informasi Bantuan Masyarakat</div>
        </div>
    </div>

    <div class="title">
        <h1>LAPORAN ADUAN MASYARAKAT</h1>
        <p>Dicetak pada {{ now()->translatedFormat('d F Y') }}</p>
    </div>

    <div class="section-title">Detail Laporan</div>
    <table class="info-table">
        <tr>
            <td class="label">Judul</td>
            <td>{{ $judul }}</td>
        </tr>
        <tr>
            <td class="label">Deskripsi</td>
            <td>{{ $deskripsi ?: '-' }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal Cetak</td>
            <td>{{ now()->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td class="label">Periode</td>
            <td>
                @if($tanggal_mulai && $tanggal_selesai)
                    {{ \Carbon\Carbon::parse($tanggal_mulai)->translatedFormat('d F Y') }}
                    –
                    {{ \Carbon\Carbon::parse($tanggal_selesai)->translatedFormat('d F Y') }}
                @else
                    Semua Periode
                @endif
            </td>
        </tr>
        <tr>
            <td class="label">Kategori</td>
            <td>
                {{ $kategori === 'semua'
                    ? 'Semua Kategori'
                    : ucwords($kategori)
                }}
            </td>
        </tr>
        <tr>
            <td class="label">Status</td>
            <td>
                {{ $status === 'semua'
                    ? 'Semua Status'
                    : ucwords($status)
                }}
            </td>
        </tr>
    </table>

    <div class="section-title">Ringkasan Statistik</div>
    <table class="stats">
        <tr>
            <td>
                <div class="stats-title">Total</div>
                <div class="stats-value">{{ $total_aduan }}</div>
            </td>
            <td>
                <div class="stats-title">Pending</div>
                <div class="stats-value">{{ $pending }}</div>
            </td>
            <td>
                <div class="stats-title">Diproses</div>
                <div class="stats-value">{{ $diproses }}</div>
            </td>
            <td>
                <div class="stats-title">Selesai</div>
                <div class="stats-value">{{ $selesai }}</div>
            </td>
            <td>
                <div class="stats-title">Ditolak</div>
                <div class="stats-value">{{ $ditolak }}</div>
            </td>
        </tr>
    </table>

    @if(!empty($chart))
        <div class="section-title">
            Distribusi Jenis Aduan
        </div>

        <img
            src="{{ $chart }}"
            style="
                width:100%;
                max-height:250px;
                margin-top:5px;
                margin-bottom:15px;
            "
        >
    @endif

    <div style="page-break-before: always;"></div>
    <div class="section-title">Daftar Aduan</div>
    <table class="aduan-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="35%">Judul</th>
                <th width="20%">Pelapor</th>
                <th width="15%">Kategori</th>
                <th width="15%">Tanggal</th>
                <th width="10%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data_aduan as $aduan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $aduan->judul }}</td>
                    <td>{{ $aduan->user->nama }}</td>
                    <td>{{ ucwords($aduan->jenis_aduan) }}</td>
                    <td>{{ $aduan->created_at->translatedFormat('d M Y') }}</td>
                    <td>{{ ucwords($aduan->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align:center; color:#9ca3af; padding:16px;">
                        Tidak ada data aduan
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dokumen ini dihasilkan secara otomatis oleh Sistem SiBantu.<br>
        Dicetak pada {{ now()->translatedFormat('d F Y H:i') }}
    </div>
</body>

</html>