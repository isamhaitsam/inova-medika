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
                                    data-bs-target="#modalLunas{{ $kunjungan->id }}">
                                    Detail
                                </button>
                            </td>
                        </tr>
                        @include('admin.pages.kasir.lunas.detail')
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
