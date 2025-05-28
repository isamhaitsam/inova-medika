@extends('admin.layout.default')

@section('page-title', 'Pendaftaran Pasien')

@section('content')
    <div class="container">
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#formTambahPasien"><i
                class="la la-plus"></i>Daftar Pasien</button>
        <div class="card">
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Pasien</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Golongan Darah</th>
                    </tr>
                </thead>
                @foreach ($pasiens as $pasien)
                    <tbody>
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pasien->nama }}</td>
                            <td>
                                @if ($pasien->jenis_kelamin == 'P')
                                    Perempuan
                                @else
                                    laki - Laki
                                @endif
                            </td>
                            <td>{{ $pasien->golongan_darah }}</td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
    </div>
    @include('admin.pages.pendaftaran.add')
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
