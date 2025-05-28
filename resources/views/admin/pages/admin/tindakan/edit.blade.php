<div class="modal fade" id="formEditTindakan{{ $tindakan->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content card">
            <form method="POST" action="{{ route('admin.tindakan.update', $tindakan->id) }}" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Edit tindakan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama Tindakan</label>
                        <input type="text" name="nama_tindakan" class="form-control"
                            value="{{ $tindakan->nama_tindakan }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Tarif</label>
                        <input type="number" step="0.01" name="tarif" class="form-control"
                            value="{{ $tindakan->tarif }}" required>
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
