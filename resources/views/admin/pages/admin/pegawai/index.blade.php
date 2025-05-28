@extends('admin.layout.default')

@section('page-title', 'Daftar Pegawai')

@section('content')
    <div class="container">
        <div class="card">
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Pegawai</th>
                        <th scope="col">Jabatan</th>
                    </tr>
                </thead>
                @foreach ($pegawais as $pegawai)
                    <tbody>
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pegawai->name }}</td>
                            <td>{{ $pegawai->jabatan }}</td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
    </div>
@endsection
