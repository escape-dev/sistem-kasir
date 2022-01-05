<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
            <a class="navbar-brand" href="javascript:void(0)">
                <img src="{{ asset('assets/img/brand/blue.png') }}" class="navbar-brand-img" alt="...">
            </a>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admins/dashboard') ? 'active' : '' }}" href="{{ route('admins.dashboard') }}">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admins/barang') ? 'active' : '' }}" href="{{ route('barang.index') }}">
                            <i class="ni ni-archive-2 text-orange"></i>
                            <span class="nav-link-text">Barang</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admins/pemasok') ? 'active' : '' }}" href="{{ route('pemasok.index') }}">
                            <i class="ni ni-delivery-fast text-primary"></i>
                            <span class="nav-link-text">Pemasok</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admins/laporan/penjualan') ? 'active' : '' }}" href="{{ route('admins.laporan.penjualan') }}">
                            <i class="ni ni-money-coins text-green"></i>
                            <span class="nav-link-text">Laporan Penjualan</span>
                        </a>
                    </li>
                </ul>
                <!-- Divider -->
                <hr class="my-3">

                <!-- Heading -->
                <h6 class="navbar-heading p-0 text-muted">
                    <span class="docs-normal">Kelola Users</span>
                </h6>

                <!-- Navigation -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admins/kasir') ? 'active' : '' }}" href="{{ route('kasir.index') }}">
                            <i class="ni ni-circle-08"></i>
                            <span class="nav-link-text">Kasir</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admins/admin') ? 'active' : '' }}" href="{{ route('admin.index') }}">
                            <i class="ni ni-badge"></i>
                            <span class="nav-link-text">Admin</span>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                        <a class="nav-link active active-pro" href="upgrade.html">
                            <i class="ni ni-send text-dark"></i>
                            <span class="nav-link-text">Upgrade to PRO</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
