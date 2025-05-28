@foreach ($kunjungans as $kunjungan)
    <div class="modal fade" id="modalPembayaran{{ $kunjungan->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content card">
                <form action="{{ route('admin.kasir.bayar', $kunjungan->id) }}" method="POST">
                    @csrf
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

                        <div class="mb-3">
                            <label for="metode_pembayaran">Metode Pembayaran</label>
                            <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
                                <option value="">-- Pilih Metode --</option>
                                <option value="cash">Cash</option>
                                <option value="debit">Debit</option>
                                <option value="transfer">Transfer</option>
                                <option value="qris">Qris</option>

                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jumlah_dibayar">Jumlah Dibayar</label>
                            <input type="number" name="jumlah_dibayar" id="jumlah_dibayar" class="form-control"
                                min="0" required>
                        </div>

                        @error('jumlah_dibayar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Bayar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
