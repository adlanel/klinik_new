<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Terapi - {{ $patient->nama_anak }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            background: white;
            padding: 2.5cm;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #2563eb;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .clinic-name {
            font-size: 24px;
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .branch-info {
            font-size: 14px;
            color: #374151;
            margin-bottom: 3px;
        }

        .document-title {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
            color: #1f2937;
            text-decoration: underline;
        }

        .content-section {
            margin-bottom: 20px;
        }

        .section-title {
            background-color: #e0e0e0;
            padding: 6px 10px;
            font-weight: bold;
            font-size: 13px;
            color: #333;
            border-left: 4px solid #007bff;
            margin-bottom: 12px;
        }

        .info-grid {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }

        .info-row {
            display: table-row;
        }

        .info-label {
            display: table-cell;
            width: 30%;
            padding: 5px 10px;
            font-weight: bold;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            vertical-align: top;
        }

        .info-value {
            display: table-cell;
            padding: 5px 10px;
            border: 1px solid #ccc;
            vertical-align: top;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            text-align: center;
        }

        .status-completed {
            background-color: #d4edda;
            color: #155724;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }

        .notes-section {
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            padding: 12px;
            margin-top: 8px;
        }

        .notes-content {
            white-space: pre-wrap;
            word-wrap: break-word;
            line-height: 1.5;
            color: #333;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 10px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
            padding-top: 15px;
        }

        .print-date {
            text-align: right;
            font-size: 10px;
            color: #6b7280;
            margin-bottom: 8px;
        }

        .signature-section {
            margin-top: 35px;
            display: table;
            width: 100%;
        }

        .signature-box {
            display: table-cell;
            width: 50%;
            text-align: center;
            padding: 0 20px;
        }

        .signature-line {
            border-top: 1px solid #333;
            margin-top: 60px;
            padding-top: 5px;
            font-size: 11px;
        }

        @page {
            margin: 1.5cm 2cm;
            size: A4;
        }
    </style>
</head>
<body>
    <!-- Header / Kop Surat -->
    <div class="header">
        <div class="clinic-name">{{ $historyDetail->nama_cabang }}</div>
        <div class="branch-info">{{ $historyDetail->cabang_alamat ?? 'Alamat tidak tersedia' }}</div>
        @if($historyDetail->cabang_telepon)
            <div class="branch-info">Telp: {{ $historyDetail->cabang_telepon }}</div>
        @endif
        <div class="document-title">LAPORAN HASIL TERAPI</div>
    </div>

    <div class="print-date">
        Dicetak pada: {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y H:i') }} WIB
    </div>

    <!-- Informasi Pasien -->
    <div class="content-section">
        <div class="section-title">INFORMASI PASIEN</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Nama Pasien</div>
                <div class="info-value">{{ $patient->nama_anak }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Jenis Kelamin</div>
                <div class="info-value">{{ $patient->jenis_kelamin ?? '-' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Usia</div>
                <div class="info-value">
                    @if($patient->tanggal_lahir)
                        {{ \Carbon\Carbon::parse($patient->tanggal_lahir)->age }} tahun
                    @else
                        -
                    @endif
                </div>
            </div>
            <div class="info-row">
                <div class="info-label">Nama Orang Tua</div>
                <div class="info-value">{{ $patient->nama_orang_tua ?? '-' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Alamat</div>
                <div class="info-value">{{ $patient->alamat ?? '-' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Telepon</div>
                <div class="info-value">{{ $patient->telepon ?? '-' }}</div>
            </div>
        </div>
    </div>

    <!-- Informasi Sesi Terapi -->
    <div class="content-section">
        <div class="section-title">INFORMASI SESI TERAPI</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Tanggal Terapi</div>
                <div class="info-value">{{ \Carbon\Carbon::parse($historyDetail->tanggal_terapi)->locale('id')->translatedFormat('l, d F Y') }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Jam Sesi</div>
                <div class="info-value">{{ $historyDetail->jam_sesi }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Jenis Layanan</div>
                <div class="info-value">{{ $historyDetail->layanan_name }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Cabang Terapi</div>
                <div class="info-value">{{ $historyDetail->nama_cabang }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Terapis</div>
                <div class="info-value">{{ $historyDetail->terapis_name ?? 'Tidak tercatat' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Jenis Paket</div>
                <div class="info-value">
                    @if($historyDetail->jenis_paket)
                        <span class="capitalize">{{ str_replace('_', ' ', $historyDetail->jenis_paket) }}</span>
                    @else
                        -
                    @endif
                </div>
            </div>
            <div class="info-row">
                <div class="info-label">Status Sesi</div>
                <div class="info-value">
                    @if($historyDetail->status == 'Sudah Dikerjakan')
                        <span class="status-badge status-completed">SUDAH DIKERJAKAN</span>
                    @elseif($historyDetail->status == 'Belum Dikerjakan')
                        <span class="status-badge status-pending">BELUM DIKERJAKAN</span>
                    @elseif($historyDetail->status == 'Cancelled')
                        <span class="status-badge status-cancelled">CANCELLED</span>
                    @else
                        <span class="status-badge status-pending">{{ strtoupper($historyDetail->status ?? 'BELUM DIKERJAKAN') }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Catatan Terapi -->
    @if($historyDetail->notes)
    <div class="content-section">
        <div class="section-title">CATATAN TERAPI</div>
        <div class="notes-section">
            <div class="notes-content">{{ $historyDetail->notes }}</div>
        </div>
    </div>
    @else
    <div class="content-section">
        <div class="section-title">CATATAN TERAPI</div>
        <div class="notes-section">
            <div class="notes-content" style="color: #9ca3af; font-style: italic;">Belum ada catatan terapi.</div>
        </div>
    </div>
    @endif

    <!-- Saran di Rumah -->
    @if($historyDetail->saran_dirumah)
    <div class="content-section">
        <div class="section-title">SARAN KEGIATAN DI RUMAH</div>
        <div class="notes-section">
            <div class="notes-content">{{ $historyDetail->saran_dirumah }}</div>
        </div>
    </div>
    @else
    <div class="content-section">
        <div class="section-title">SARAN KEGIATAN DI RUMAH</div>
        <div class="notes-section">
            <div class="notes-content" style="color: #9ca3af; font-style: italic;">Belum ada saran kegiatan di rumah.</div>
        </div>
    </div>
    @endif

    <!-- Tanda Tangan -->
    <div class="signature-section">
        <div class="signature-box">
            <div>Terapis</div>
            <div class="signature-line">{{ $historyDetail->terapis_name ?? '(_________________)' }}</div>
        </div>
        <div class="signature-box">
            <div>Orang Tua/Wali</div>
            <div class="signature-line">(_________________)</div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Dokumen ini digenerate secara otomatis oleh sistem {{ $historyDetail->nama_cabang }}</p>
        <p>{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y H:i') }} WIB</p>
    </div>
</body>
</html>