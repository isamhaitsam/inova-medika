@extends('admin.layout.default')

@section('page-title', 'Daftar Tindakan')

@section('content')
    <div class="container">
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#formTambahTindakan"><i
                class="la la-plus"></i>Tambah Tindakan</button>
        <div class="card">
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Tindakan</th>
                        <th scope="col">Tarif</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                @foreach ($tindakans as $tindakan)
                    <tbody>
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tindakan->nama_tindakan }}</td>
                            <td>{{ $tindakan->tarif }}</td>
                            <td> <button class="btn btn-warning mb-3" data-bs-toggle="modal"
                                    data-bs-target="#formEditTindakan{{ $tindakan->id }}"><i
                                        class="la la-edit"></i></button>
                                <form id="delete-form-{{ $tindakan->id }}"
                                    action="{{ route('admin.tindakan.destroy', $tindakan->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <button onclick="confirmDelete({{ $tindakan->id }})" class="btn btn-danger mb-3">
                                    <i class="la la-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    @include('admin.pages.admin.tindakan.edit', ['tindakan' => $tindakan])
                @endforeach
            </table>
        </div>
    </div>
    @include('admin.pages.admin.tindakan.add')
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data Tindakan akan dihapus permanen!",
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
