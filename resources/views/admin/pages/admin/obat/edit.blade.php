<div class="modal fade" id="formEditObat{{ $obat->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content card">
            <form method="POST" action="{{ route('admin.obat.update', $obat->id) }}" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Edit Obat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama Obat</label>
                        <input type="text" name="nama_obat" class="form-control" value="{{ $obat->nama_obat }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label>Harga</label>
                        <input type="number" step="0.01" name="harga" class="form-control"
                            value="{{ $obat->harga }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>

    </div>
</div>
