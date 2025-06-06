<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.html" class="brand-link">
        <img src="../assets/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">SembodoSehat</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">Admin</a>
            </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item ">
                    <a href="../admin/index.php?page=dashboard" class="nav-link ">
                        <p>Dashboard </p>
                    </a>
                </li>
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-plus"></i>
                        <p>
                            Tambah Konten
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../admin/index.php?page=tambah_artikel" class="nav-link">
                                <i class="nav-icon fas fa-pencil-alt"></i>
                                <p>Artikel</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../admin/index.php?page=tambah_video" class="nav-link ">
                                <i class="nav-icon fas fa-video"></i>
                                <p>Video</p>
                            </a>
                        </li>
                    </ul>

                <li class="nav-item ">
                    <a href="../admin/index.php?page=tambah_penyakit" class="nav-link ">
                        <p>Tambah Riwayat Penyakit</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="../admin/index.php?page=logout" class="nav-link ">
                        <p>Logout</p>
                    </a>
                </li>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>