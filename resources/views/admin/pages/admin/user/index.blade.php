@extends('admin.layout.default')

@section('page-title', 'Daftar User')

@section('content')
    <div class="container">
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#formTambahUser"><i
                class="la la-plus"></i>Tambah User</button>
        <div class="card">
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama User</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                @foreach ($users as $user)
                    <tbody>
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><button class="btn btn-warning mb-3" data-bs-toggle="modal"
                                    data-bs-target="#formEditUser{{ $user->id }}"><i class="la la-edit"></i></button>
                                <form id="delete-form-{{ $user->id }}"
                                    action="{{ route('admin.user.destroy', $user->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <button onclick="confirmDelete({{ $user->id }})" class="btn btn-danger mb-3">
                                    <i class="la la-trash"></i>
                                </button>
                            </td>

                        </tr>
                    </tbody>
                    @include('admin.pages.admin.user.edit', ['user' => $user])
                @endforeach
            </table>
        </div>
    </div>
    @include('admin.pages.admin.user.add')
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
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data User akan dihapus permanen!",
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

@endsection
