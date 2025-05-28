<!-- Modal Edit User & Pegawai -->
<div class="modal fade" id="formEditUser{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content card">
            <form method="POST" action="{{ route('admin.user.update', $user->id) }}" class="modal-content">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Edit User & user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Password (kosongkan jika tidak diubah)</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Jabatan</label>
                        <select name="jabatan" class="form-control input-square mt-2" required>
                            <option value="Dokter" {{ $user->jabatan == 'Dokter' ? 'selected' : '' }}>Dokter</option>
                            <option value="Kasir" {{ $user->jabatan == 'Kasir' ? 'selected' : '' }}>Kasir</option>
                            <option value="Staff" {{ $user->jabatan == 'Staff' ? 'selected' : '' }}>Staff</option>
                            <option value="Perawat" {{ $user->jabatan == 'Perawat' ? 'selected' : '' }}>Perawat</option>
                            <option value="Pendaftaran" {{ $user->jabatan == 'Pendaftaran' ? 'selected' : '' }}>
                                Pendaftaran
                            </option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>

    </div>
</div>
