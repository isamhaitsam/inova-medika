<div class="modal fade" id="formTanganiPasien{{ $kunjungans->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content card">
            <form method="POST" action="{{ route('admin.dokter.update', $kunjungans->id) }}">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Tangani Pasien</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    {{-- Data Pasien --}}
                    <div class="mb-3">
                        <label>Nama Pasien</label>
                        <input type="text" class="form-control" value="{{ $kunjungans->pasien->nama }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label>Golongan Darah</label>
                        <input type="text" class="form-control" value="{{ $kunjungans->pasien->golongan_darah }}"
                            readonly>
                    </div>
                    <div class="mb-3">
                        <label>Keluhan</label>
                        <input type="text" class="form-control" value="{{ $kunjungans->keluhan }}" readonly>
                    </div>

                    {{-- Multiple select Tindakan --}}
                    <label for="tindakan">Tindakan</label>
                    <select name="tindakan_ids[]" class="form-control input-square" multiple size="5"
                        id="tindakan">
                        @foreach ($semuaTindakan as $t)
                            <option value="{{ $t->id }}">{{ $t->nama_tindakan }}
                                (Rp{{ number_format($t->tarif) }})
                            </option>
                        @endforeach
                    </select>
                    <div class="mb-3 mt-3">
                        <label for="catatan">Catatan</label>
                        <textarea name="catatan" class="form-control" rows="3" placeholder="Catatan penanganan umum..."></textarea>
                    </div>


                    {{-- Obat dengan jumlah --}}
                    <label class="mt-3">Obat & Jumlah</label>
                    @foreach ($semuaObat as $obat)
                        <div class="d-flex align-items-center mb-2 mt-3">
                            <div>
                                <label>
                                    {{ $obat->nama_obat }} (Rp{{ number_format($obat->harga) }})
                                </label>
                            </div>

                        </div>
                        <input type="number" name="obat[{{ $obat->id }}][jumlah]" class="form-control input-pill"
                            placeholder="Jumlah" min="0" value="0">
                        <hr>
                    @endforeach


                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>

</div>
