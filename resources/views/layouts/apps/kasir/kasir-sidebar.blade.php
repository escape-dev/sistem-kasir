<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
            <a class="navbar-brand" href="javascript:void(0)">
                <img src="../assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
            </a>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('penjualan')" href="{{ route('penjualan.send') }}">
                            <i class="ni ni-shop text-orange"></i>
                            <span class="nav-link-text">Penjualan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('pembelian')" href="{{ route('pemasok.pemasok') }}">
                            <i class="ni ni-cart text-primary"></i>
                            <span class="nav-link-text">Pembelian</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>