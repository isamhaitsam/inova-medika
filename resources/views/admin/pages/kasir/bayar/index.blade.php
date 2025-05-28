@extends('admin.layout.default')

@section('page-title', 'Daftar Pasien')

@section('content')
    <div class="container">
        <div class="card">
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Pasien</th>
                        <th scope="col">Tanggal Tindakan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kunjungans as $kunjungan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kunjungan->pasien->nama }}</td>
                            <td>{{ $kunjungan->created_at->format('d M Y') }}</td>
                            <td>
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalPembayaran{{ $kunjungan->id }}">
                                    Bayar
                                </button>
                            </td>
                        </tr>
                        @include('admin.pages.kasir.bayar.detail')
                    @endforeach

                </tbody>
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
