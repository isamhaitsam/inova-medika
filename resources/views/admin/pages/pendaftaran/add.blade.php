<div class="modal fade" id="formTambahPasien" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.pendaftaran.store') }}" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pasien & Kunjungan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label>Nama Pasien</label>
                    <input type="text" name="nama" class="form-control" required value="{{ old('nama') }}">
                    @error('nama')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>NIK</label>
                    <input type="text" name="nik" class="form-control" required value="{{ old('nik') }}">
                    @error('nik')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control input-square" required>
                        <option value="">-- Pilih --</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Golongan Darah (opsional)</label>
                    <input type="text" name="golongan_darah" class="form-control"
                        value="{{ old('golongan_darah') }}">
                    @error('golongan_darah')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <hr>

                <div class="mb-3">
                    <label>Keluhan</label>
                    <textarea name="keluhan" class="form-control" rows="3" required>{{ old('keluhan') }}</textarea>
                    @error('keluhan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </form>
    </div>
</div>
