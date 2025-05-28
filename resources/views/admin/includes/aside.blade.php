<div class="sidebar">
    <div class="scrollbar-inner sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item">
                <a href="/admin/dashboard">
                    <i class="la la-dashboard"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            @if (Auth::check() && Auth::user()->roles_id === 3)
                <li class="nav-item">
                    <a href="/admin/belumditangani">
                        <i class="fa fa-minus-square"></i>
                        <p>Pasien Belum Ditangani</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/sudahditangani">
                        <i class="fas fa-user-check"></i>
                        <p>Pasien Sudah Ditangani</p>
                    </a>
                </li>
            @endif
            @if (Auth::check() && Auth::user()->roles_id === 2)
                <li class="nav-item">
                    <a href="/admin/daftarpasien">
                        <i class="fa fa-user-plus"></i>
                        <p>Daftar Pasien Belum Lunas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/daftarpasienlunas">
                        <i class="fa fa-user-plus"></i>
                        <p>Daftar Pasien Sudah Lunas</p>
                    </a>
                </li>
            @endif
            @if (Auth::check() && Auth::user()->roles_id === 4)
                <li class="nav-item">
                    <a href="/admin/pendaftaranpasien">
                        <i class="fa fa-user-plus"></i>
                        <p>Pendaftaran Pasien</p>
                    </a>
                </li>
            @endif
            @if (Auth::check() && Auth::user()->roles_id === 1)
                <li class="nav-item">
                    <a href="/admin/daftarobat">
                        <i class="fas fa-pills"></i>
                        <p>Daftar Obat</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/daftaruser">
                        <i class="la la-user"></i>
                        <p>Daftar User</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/daftarpegawai">
                        <i class="la la-user"></i>
                        <p>Daftar Pegawai</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/daftartindakan">
                        <i class="fas fa-notes-medical"></i>
                        <p>Daftar Tindakan</p>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
