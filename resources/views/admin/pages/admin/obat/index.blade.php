@extends('admin.layout.default')

@section('page-title', 'Daftar Obat')

@section('content')
    <div class="container">
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#formTambahObat"><i
                class="la la-plus"></i>Tambah Obat</button>
        <div class="card">
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Obat</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                @foreach ($obats as $obat)
                    <tbody>
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $obat->nama_obat }}</td>
                            <td>{{ $obat->harga }}</td>
                            <td>
                                <button class="btn btn-warning mb-3" data-bs-toggle="modal"
                                    data-bs-target="#formEditObat{{ $obat->id }}"><i class="la la-edit"></i></button>
                                <form id="delete-form-{{ $obat->id }}"
                                    action="{{ route('admin.obat.destroy', $obat->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <button onclick="confirmDelete({{ $obat->id }})" class="btn btn-danger mb-3">
                                    <i class="la la-trash"></i>
                                </button>

                            </td>
                        </tr>
                    </tbody>
                    @include('admin.pages.admin.obat.edit', ['obat' => $obat])
                @endforeach
            </table>
        </div>
    </div>

    @include('admin.pages.admin.obat.add')
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data obat akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>

    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: '{{ session('success') }}',
                    timer: 2000,
                    showConfirmButton: false
                });
            });
        </script>
    @endif
@endsection
