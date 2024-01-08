<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon">
            <i class="fas fa-bullhorn"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Aspirasi Masyarakat</div>
    </a>
    <style>

    </style>
    <?php if (session()->get('user_level') == 1) : ?>
        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Manajemen Data
        </div>
        <li class="nav-item <?= url_is('/admin/manage-lokasi') ? 'active' : '' ?>">
        <a class="nav-link" href="/admin/manage-lokasi">
            <i class="fas fa-fw fa-map-marker"></i>

            <span>Lokasi</span></a>
        </li>
        <li class="nav-item <?= url_is('/admin/manage-user') || url_is('/admin/manage-user/un-verified') ? 'active' : '' ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#users" aria-expanded="true" aria-controls="users">
                <?php if (url_is('/admin/manage-user/un-verified')) : ?>
                    <i class="fas fa-user-times"></i>
                <?php else : ?>
                    <i class="fas fa-users"></i>
                <?php endif; ?>
                <span>Daftar Anggota</span>
            </a>
            <div id="users" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Anggota</h6>
                    <a class="collapse-item" href="/admin/manage-user">Semua Anggota</a>
                    <a class="collapse-item" href="/admin/manage-user/un-verified">Belum Terverifikasi</a>
                    
                </div>
        </li>
    <?php endif; ?>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Menu
    </div>

    <?php if (session()->get('user_level') == 1) : ?>
        <li class="nav-item <?= url_is('/admin/pengaduan/di-proses') || url_is('/admin/pengaduan/selesai') ? 'active' : '' ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pengaduan" aria-expanded="true" aria-controls="pengaduan">
                <?php if (url_is('/admin/pengaduan/di-proses')) : ?>
                    <i class="fas fa-spinner"></i>
                <?php elseif (url_is('/admin/pengaduan/selesai')) : ?>
                    <i class="fas fa-check-square"></i>
                <?php else : ?>
                    <i class="fas fa-list"></i>
                <?php endif; ?>
                <span>Daftar Aspirasi</span>
            </a>
            <div id="pengaduan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="/admin/pengaduan/di-proses">Diproses</a>
                    <a class="collapse-item" href="/admin/pengaduan/selesai">Selesai</a>
                </div>
            </div>
        </li>
    <?php endif; ?>

    <?php if (session()->get('user_level') == 2) : ?>
        
        <li class="nav-item <?= url_is('/admin/pengaduan') || url_is('/admin/pengaduan/masuk') ? 'active' : '' ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pengaduan" aria-expanded="true" aria-controls="pengaduan">
                <?php if (url_is('/admin/pengaduan/masuk')) : ?>
                    <i class="fas fa-envelope-open"></i>
                <?php else : ?>
                    <i class="fas fa-list"></i>
                <?php endif; ?>
                <span>Daftar Aspirasi</span>
            </a>
            <div id="pengaduan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="/admin/pengaduan/masuk">Aspirasi Masuk</a>
                    <a class="collapse-item" href="/admin/pengaduan/setuju">Aspirasi Disetujui</a>
                </div>
            </div>
           
        </li>
    <?php endif; ?>
    
    <?php if (session()->get('user_level') == 4) : ?>
        <li class="nav-item <?= url_is('/admin/pengaduan') || url_is('/admin/pengaduan/selesai') ? 'active' : '' ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pengaduan" aria-expanded="true" aria-controls="pengaduan">
                <?php if (url_is('/admin/pengaduan/selesai')) : ?>
                    <i class="fas fa-envelope-open"></i>
                <?php else : ?>
                    <i class="fas fa-list"></i>
                <?php endif; ?>
                <span>Daftar Aspirasi</span>
            </a>
            <div id="pengaduan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="/admin/pengaduan/selesai">Aspirasi Disetujui</a>
                  
                </div>
            </div>
        </li>
    <?php endif; ?>


    <?php $userLevel = session()->get('user_level'); ?>
        <?php if ($userLevel == 2 || $userLevel == 3 || $userLevel == 4) : ?>
        <li class="nav-item <?= url_is('/pengaduan') || url_is('/pengaduan/tambah') ? 'active' : '' ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsTwo" aria-expanded="true" aria-controls="collapsTwo">
                <?php if (url_is('/pengaduan/tambah')) : ?>
                    <i class="fas fa-plus"></i>
                <?php else : ?>
                    <i class="fas fa-list"></i>
                <?php endif; ?>
                <span>Aspirasi Saya</span>
            </a>
            <div id="collapsTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="/pengaduan">Daftar Pengaduan</a>
                    <a class="collapse-item" href="/pengaduan/tambah">Tambah Baru</a>
                </div>
            </div>
        </li>
    <?php endif; ?>

    <hr class="sidebar-divider">

    <!-- Heading -->

    <div class="sidebar-heading">
        Profile
    </div>

    <li class="nav-item <?= url_is('/user') ? 'active' : '' ?>">
        <a class="nav-link" href="/user">
            <i class="fas fa-fw fa-user"></i>
            <span>Akun Saya</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <li class="nav-item">
        <a class="nav-link pt-0" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Keluar</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>