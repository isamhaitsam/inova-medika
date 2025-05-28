<div class="modal fade" id="detailModal{{ $kunjungan->id }}" tabindex="-1"
    aria-labelledby="detailModalLabel{{ $kunjungan->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel{{ $kunjungan->id }}">Detail Kunjungan Pasien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>Data Pasien</h6>
                <p><strong>Nama:</strong> {{ $kunjungan->pasien->nama }}</p>
                <p><strong>Golongan Darah:</strong> {{ $kunjungan->pasien->golongan_darah }}</p>
                <p><strong>Keluhan:</strong> {{ $kunjungan->keluhan }}</p>
                <hr>

                <h6>Daftar Tindakan</h6>
                @if ($kunjungan->tindakan->count() > 0)
                    <ul>
                        @foreach ($kunjungan->tindakan as $t)
                            <li>
                                {{ $t->nama_tindakan }} (Rp{{ number_format($t->tarif) }})
                                <br>
                                <small>Catatan: {{ $t->pivot->catatan ?? '-' }}</small>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p><em>Tidak ada tindakan.</em></p>
                @endif
                <hr>

                <h6>Daftar Obat</h6>
                @if ($kunjungan->obat->count() > 0)
                    <ul>
                        @foreach ($kunjungan->obat as $o)
                            <li>
                                {{ $o->nama_obat }} (Rp{{ number_format($o->harga) }}) x {{ $o->pivot->jumlah }} =
                                Rp{{ number_format($o->harga * $o->pivot->jumlah) }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p><em>Tidak ada obat.</em></p>
                @endif
                <hr>

                <p><strong>Total Biaya:</strong> Rp{{ number_format($kunjungan->total_biaya) }}</p>
                <p><strong>Status:</strong> {{ $kunjungan->status }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
