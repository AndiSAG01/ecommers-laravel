<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="/">
            <span class="sidebar-brand-text align-middle"> Fas Vapor Store </span>
        </a>
        <ul class="sidebar-nav">
            <li class="sidebar-header"> Home </li>
            <li class="sidebar-item @yield('active-dashboard')">
                <a class="sidebar-link" href="{{ route('dashboard.index') }}">
                    <i class="align-middle" data-feather="home"></i>
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-header"> Halaman </li>
            <li class="sidebar-item @yield('active-kategori')">
                <a data-bs-target="#kategori" data-bs-toggle="collapse" class="sidebar-link">
                    <i class="align-middle" data-feather="grid"></i>
                    <span class="align-middle">Kategori</span>
                </a>
                <ul id="kategori" class="sidebar-dropdown list-unstyled collapse @yield('show-kategori')" data-bs-parent="#sidebar">
                    <li class="sidebar-item @yield('active-data-kategori')">
                        <a class="sidebar-link" href="{{ route('category.index') }}">Data Kategori</a>
                    </li>
                    <li class="sidebar-item @yield('active-tambah-kategori')">
                        <a class="sidebar-link" href="{{ route('category.create') }}">Tambah Kategori</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item @yield('active-produk')">
                <a data-bs-target="#produk" data-bs-toggle="collapse" class="sidebar-link">
                    <i class="align-middle" data-feather="grid"></i>
                    <span class="align-middle">Produk</span>
                </a>
                <ul id="produk" class="sidebar-dropdown list-unstyled collapse @yield('show-produk')" data-bs-parent="#sidebar">
                    <li class="sidebar-item @yield('active-data-produk')">
                        <a class="sidebar-link" href="{{ route('product.index') }}">Data Produk</a>
                    </li>
                    <li class="sidebar-item @yield('active-tambah-produk')">
                        <a class="sidebar-link" href="{{ route('product.create') }}">Tambah Produk</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-header"> Transaksi </li>
            <li class="sidebar-item @yield('active-pesanan')">
                <a class="sidebar-link" href="{{ route('order.index') }}">
                    <i class="align-middle" data-feather="grid"></i>
                    <span class="align-middle">Pesanan</span>
                </a>
            </li>
            <li class="sidebar-item @yield('active-laporan')">
                <a data-bs-target="#laporan" data-bs-toggle="collapse" class="sidebar-link">
                    <i class="align-middle" data-feather="grid"></i>
                    <span class="align-middle">Laporan</span>
                </a>
                <ul id="laporan" class="sidebar-dropdown list-unstyled collapse @yield('show-laporan')" data-bs-parent="#sidebar">
                    <li class="sidebar-item @yield('active-laporan-pesanan')">
                        <a class="sidebar-link" href="{{ route('report.order') }}">Laporan Pesanan</a>
                    </li>
                    <li class="sidebar-item @yield('active-laporan-pengembalian')">
                        <a class="sidebar-link" href="{{ route('report.return') }}">Laporan Pengembalian</a>
                    </li>
                    <li class="sidebar-item @yield('active-laporan-produk')">
                        <a class="sidebar-link" href="{{ route('report.product') }}">Laporan Produk</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
