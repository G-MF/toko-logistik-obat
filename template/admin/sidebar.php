<ul class="navbar-nav bg-gray-900 sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin') ?>">
        <div class="sidebar-brand-icon">
            <img src="<?= base_url('assets/img/drugstore-icon.png') ?>" style="width: 50px; height: 50px;">
        </div>
        <div class=" sidebar-brand-text text-left mt-3 ml-2" style="font-size: 12px;">
            Toko ARIF FAJAR TABALONG
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= page_active('admin') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('admin') ?>">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <li class="nav-item <?= page_active('karyawan') || page_active('pelanggan') || page_active('supplier') || page_active('stok') ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#master" aria-expanded="true" aria-controls="master">
            <i class="fas fa-fw fa-database"></i>
            <span>Master Data</span>
        </a>
        <div id="master" class="collapse <?= page_active('karyawan') || page_active('pelanggan') || page_active('supplier') || page_active('stok') ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?= page_active('karyawan') ? 'active' : '' ?>" href="<?= base_url('admin/karyawan') ?>">Karyawan</a>
                <a class="collapse-item <?= page_active('pelanggan') ? 'active' : '' ?>" href="<?= base_url('admin/pelanggan') ?>">Pelanggan</a>
                <a class="collapse-item <?= page_active('supplier') ? 'active' : '' ?>" href="<?= base_url('admin/supplier') ?>">Supplier</a>
                <a class="collapse-item <?= page_active('stok') ? 'active' : '' ?>" href="<?= base_url('admin/stok') ?>">Stok</a>
            </div>
        </div>
    </li>


    <li class="nav-item <?= page_active('pembelian-obat') || page_active('penjualan-obat') ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transaksi" aria-expanded="true" aria-controls="transaksi">
            <i class="fas fa-fw fa-balance-scale"></i>
            <span>Transaksi</span>
        </a>
        <div id="transaksi" class="collapse <?= page_active('pembelian-obat') || page_active('penjualan-obat') ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?= page_active('pembelian-obat') ? 'active' : '' ?>" href="<?= base_url('admin/pembelian-obat') ?>">Pembelian Obat</a>
                <a class="collapse-item <?= page_active('penjualan-obat') ? 'active' : '' ?>" href="<?= base_url('admin/penjualan-obat') ?>">Penjualan Obat</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <div class="sidebar-heading">
        Laporan
    </div>

    <!-- <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#modal-report">
            <i class="fas fa-fw fa-list"></i>
            <span>Laporan</span>
        </a>
    </li> -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#laporan" aria-expanded="true" aria-controls="laporan">
            <i class="fas fa-fw fa-list"></i>
            <span>Laporan</span>
        </a>
        <div id="laporan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" target="_blank" href="<?= base_url('admin/laporan/karyawan') ?>">Karyawan</a>
                <a class="collapse-item" target="_blank" href="<?= base_url('admin/laporan/pelanggan') ?>">Pelanggan</a>
                <a class="collapse-item" target="_blank" href="<?= base_url('admin/laporan/supplier') ?>">Supplier</a>
                <a class="collapse-item" target="_blank" href="<?= base_url('admin/laporan/stok-obat') ?>">Stok Obat</a>
                <a class="collapse-item" target="_blank" href="<?= base_url('admin/laporan/pembelian-obat') ?>">Pembelian Obat</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <div class="sidebar-heading">
        Akun
    </div>

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#modal-edit-username">
            <i class="fas fa-fw fa-user-edit"></i>
            <span>Ubah Username</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#modal-edit-pw">
            <i class="fas fa-fw fa-lock"></i>
            <span>Ubah Password</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#modal-logout">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>