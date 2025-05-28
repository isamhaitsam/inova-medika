<!DOCTYPE html>
<html>
<head>
    <title>Cetak Kunjungan PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px;}
        table, th, td { border: 1px solid black; padding: 8px; }
    </style>
</head>
<body>
    <h3>Data Pasien</h3>
    <p><strong>Nama:</strong> {{ $kunjungan->pasien->nama }}</p>
    <p><strong>Golongan Darah:</strong> {{ $kunjungan->pasien->golongan_darah }}</p>
    <p><strong>Keluhan:</strong> {{ $kunjungan->keluhan }}</p>
    <p><strong>Total Tagihan:</strong> Rp{{ number_format($kunjungan->total_biaya) }}</p>

    <h4>Daftar Tindakan</h4>
    @if ($kunjungan->tindakan->count() > 0)
    <table>
        <thead>
            <tr>
                <th>Tindakan</th>
                <th>Tarif</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kunjungan->tindakan as $t)
            <tr>
                <td>{{ $t->nama_tindakan }}</td>
                <td>Rp{{ number_format($t->tarif) }}</td>
                <td>{{ $t->pivot->catatan ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p><em>Tidak ada tindakan.</em></p>
    @endif

    <h4>Daftar Obat</h4>
    @if ($kunjungan->obat->count() > 0)
    <table>
        <thead>
            <tr>
                <th>Obat</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kunjungan->obat as $o)
            <tr>
                <td>{{ $o->nama_obat }}</td>
                <td>Rp{{ number_format($o->harga) }}</td>
                <td>{{ $o->pivot->jumlah }}</td>
                <td>Rp{{ number_format($o->harga * $o->pivot->jumlah) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p><em>Tidak ada obat.</em></p>
    @endif

    <p><strong>Jumlah Dibayar :</strong> Rp{{ number_format($kunjungan->pembayaran->jumlah_dibayar ?? 0) }}</p>
    <p><strong>Kembalian :</strong> Rp{{ number_format($kunjungan->pembayaran->kembalian ?? 0) }}</p>

</body>
</html>
