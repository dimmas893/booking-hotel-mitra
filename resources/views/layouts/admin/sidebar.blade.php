    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="index.html">Booking Hotel</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <a href="index.html">BH</a>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-header">Dashboard</li>
                {{-- <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                    <ul class="dropdown-menu">
                        <li class=active><a class="nav-link" href="index-0.html">General Dashboard</a></li>
                        <li><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
                    </ul>
                </li> --}}
                @if (Auth::user()->role === 'admin')
                    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="ion-document-text h4 mt-2"data-pack="default"></i>Dashboard</a>
                    </li>
                    <li class="menu-header">Admin</li>
                    <li class="nav-item {{ request()->is('admin') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin') }}">
                            <i class="ion-document-text h4 mt-2"data-pack="default"></i>Admin</a>
                    </li>
                    <li class="nav-item {{ request()->is('jenismitra') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('jenismitra') }}">
                            <i class="ion-document-text h4 mt-2"data-pack="default"></i>Jenis Mitra</a>
                    </li>
                    <li class="nav-item {{ request()->is('unitsewafasilitas') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('unitsewafasilitas') }}">
                            <i class="ion-document-text h4 mt-2"data-pack="default"></i>Unit Sewa Fasilitas</a>
                    </li>
                    <li class="nav-item {{ request()->is('rekeningowner') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('rekeningowner') }}">
                            <i class="ion-document-text h4 mt-2"data-pack="default"></i>Rekening Owner</a>
                    </li>
                    <li class="nav-item {{ request()->is('jenisfasilitas') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('jenisfasilitas') }}">
                            <i class="ion-document-text h4 mt-2"data-pack="default"></i>Jenis Fasilitas</a>
                    </li>
                    <li class="nav-item {{ request()->is('mitra') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('mitra') }}">
                            <i class="ion-document-text h4 mt-2"data-pack="default"></i>Mitra</a>
                    </li>
                    <li class="nav-item {{ request()->is('fasilitas') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('fasilitas') }}">
                            <i class="ion-document-text h4 mt-2"data-pack="default"></i>Fasilitas</a>
                    </li>
                    <li class="nav-item {{ request()->is('pesananadmin') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('pesananadmin') }}">
                            <i class="ion-document-text h4 mt-2"data-pack="default"></i>Pesanan</a>
                    </li>
                @endif

                @if (Auth::user()->role === 'mitra')
                    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="ion-document-text h4 mt-2"data-pack="default"></i>Dashboard</a>
                    </li>

                    <li class="nav-item {{ request()->is('mitrapendapatan') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('mitrapendapatan') }}">
                            <i class="ion-document-text h4 mt-2"data-pack="default"></i>Pendapatan Mitra</a>
                    </li>

                    <li class="nav-item {{ request()->is('mitramitra') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('mitramitra') }}">
                            <i class="ion-document-text h4 mt-2"data-pack="default"></i>Profil Mitra</a>
                    </li>
                    <li class="nav-item {{ request()->is('cekpesananviewmitra') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('cekpesananviewmitra') }}">
                            <i class="ion-document-text h4 mt-2"data-pack="default"></i>Pesanan</a>
                    </li>
                @endif

            </ul>

            <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                <form action="{{ route('logoutaplikasi') }}" method="post">
                    @csrf
                    <div class="dropdown-divider"></div>
                    <button class="btn btn-danger btn-lg btn-block btn-icon-split">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </aside>
    </div>
