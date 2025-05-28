@extends('admin.layout.default')

@section('page-title', 'Pasien Belum Ditangani')

@section('content')
    <div class="container">
        <div class="card">
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Pasien</th>
                        <th scope="col">Keluhan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                @foreach ($kunjungan as $kunjungans)
                    <tbody>
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kunjungans->pasien->nama }}</td>
                            <td>{{ $kunjungans->keluhan }}</td>
                            <td> <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#formTanganiPasien{{ $kunjungans->id }}">
                                    Tangani
                                </button></td>
                            @include('admin.pages.dokter.belum.tindakan')
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
    </div>
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
