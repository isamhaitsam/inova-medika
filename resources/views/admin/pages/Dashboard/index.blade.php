@extends('admin.layout.default')

@section('page-title', 'Dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-stats card-warning">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fa fa-stethoscope"></i>
                                </div>
                            </div>
                            <div class="col-7 d-flex align-items-center">
                                <div class="numbers">
                                    <p class="card-category">Total Pegawai</p>
                                    <h4 class="card-title">{{ number_format($totalPegawai) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stats card-success">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="la la-users"></i>
                                </div>
                            </div>
                            <div class="col-7 d-flex align-items-center">
                                <div class="numbers">
                                    <p class="card-category">Total Pasien Berkunjung</p>
                                    <h4 class="card-title">{{ number_format($totalPasien) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stats card-danger">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fa fa-medkit"></i>
                                </div>
                            </div>
                            <div class="col-7 d-flex align-items-center">
                                <div class="numbers">
                                    <p class="card-category">Pasien Belum Ditangani</p>
                                    <h4 class="card-title">{{ number_format($belumDitangani) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stats card-primary">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="	fa fa-credit-card"></i>
                                </div>
                            </div>
                            <div class="col-7 d-flex align-items-center">
                                <div class="numbers">
                                    <p class="card-category">Pasien Belum Bayar</p>
                                    <h4 class="card-title">{{ number_format($belumBayar) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Grafik Jumlah Pasien</h4>
                        <p class="card-category">Jumlah pasien per bulan</p>
                    </div>
                    <div class="card-body">
                        <canvas id="chartPasien" class="chart"></canvas>
                    </div>
                </div>
            </div>

            <script>
                const ctx = document.getElementById('chartPasien').getContext('2d');

                // Kita buat data bubble dengan radius (r) bisa diatur misal berdasarkan jumlah pasien, atau tetap sama
                const bubbleData = @json($bulanLabels).map((bulan, index) => ({
                    x: bulan,
                    y: @json($jumlahPasien)[index],
                    r: 10 // kamu bisa ganti angka ini supaya bubble lebih besar/kecil
                }));

                const chart = new Chart(ctx, {
                    type: 'bubble',
                    data: {
                        datasets: [{
                            label: 'Jumlah Pasien per Bulan',
                            data: bubbleData,
                            backgroundColor: 'rgba(75, 192, 192, 0.6)',
                            borderColor: 'rgba(75, 192, 192, 1)'
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                type: 'category', // pakai kategori agar label bulan muncul di sumbu x
                                labels: @json($bulanLabels),
                                title: {
                                    display: true,
                                    text: 'Bulan'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Jumlah Pasien'
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return `Bulan: ${context.raw.x}, Jumlah: ${context.raw.y}`;
                                    }
                                }
                            }
                        }
                    }
                });
            </script>

        </div>
    </div>


@endsection
