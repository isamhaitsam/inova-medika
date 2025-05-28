@extends('admin.layout.default')

@section('page-title', 'Pasien Sudah Ditangani')

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
                            <td><button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#detailModal{{ $kunjungan->id }}">
                                    Detail
                                </button></td>
                                @include('admin.pages.dokter.sudah.detail')
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
