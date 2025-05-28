@foreach ($kunjungans as $kunjungan)
    <div class="modal fade" id="modalLunas{{ $kunjungan->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content card">
                <div class="modal-header">
                    <h5 class="modal-title">Pembayaran Pasien: {{ $kunjungan->pasien->nama }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <h6>Data Pasien</h6>
                    <p><strong>Nama:</strong> {{ $kunjungan->pasien->nama }}</p>
                    <p><strong>Golongan Darah:</strong> {{ $kunjungan->pasien->golongan_darah }}</p>
                    <p><strong>Keluhan:</strong> {{ $kunjungan->keluhan }}</p>
                    <p><strong>Total Tagihan:</strong> Rp{{ number_format($kunjungan->total_biaya) }}</p>
                    <p><strong>Daftar Tindakan</strong></p>
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

                    <p><strong>Daftar Obat</strong></p>
                    @if ($kunjungan->obat->count() > 0)
                        <ul>
                            @foreach ($kunjungan->obat as $o)
                                <li>
                                    {{ $o->nama_obat }} (Rp{{ number_format($o->harga) }}) x
                                    {{ $o->pivot->jumlah }} =
                                    Rp{{ number_format($o->harga * $o->pivot->jumlah) }}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p><em>Tidak ada obat.</em></p>
                    @endif
                    <hr>
                    <p><strong>Jumlah Dibayar :</strong> Rp.
                        {{ number_format($kunjungan->pembayaran->jumlah_dibayar) }}
                    </p>
                    <p><strong>Kembalian :</strong> Rp. {{ number_format($kunjungan->pembayaran->kembalian) }}</p>
                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('admin.kasir.cetak_pdf', $kunjungan->id) }}" target="_blank"
                            class="btn btn-primary">
                            <i class="la la-archive"></i> Cetak PDF
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endforeach
