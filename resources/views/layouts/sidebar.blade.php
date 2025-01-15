<div class="sidebar-wrapper active">
    <div class="sidebar-header position-relative">
        <div class="d-flex justify-content-between align-items-center">
            <div class="logo">
                <a href="{{ url('/') }}">
                    <h1>PT GPT</h1>
                </a>
            </div>
            <div class="sidebar-toggler  x">
                <a class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-title">Menu</li>

            <li class="sidebar-item {{ Request::is('/') ? 'active' : '' }}">
                <a href="{{ url('/') }}" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            @if (auth()->user()->role->name == 'admin')
                <li class="sidebar-item has-sub {{ Request::is('cashs.index*') ? 'active' : '' }}">
                    <a class='sidebar-link'>
                        <i class="bi bi-cash"></i>
                        <span>Kas</span>
                    </a>

                    <ul class="submenu">
                        <li class="submenu-item {{ Request::routeIs('cashs.index') ? 'active' : '' }}">
                            <a href="{{ route('cashs.index') }}" class="submenu-link">Daftar Kas Masuk</a>
                        </li>
                        <li class="submenu-item {{ Request::routeIs('cashs-out.index') ? 'active' : '' }}">
                            <a href="{{ route('cashs-out.index') }}" class="submenu-link">Daftar Kas Keluar</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item has-sub {{ Request::is('categories.index*') ? 'active' : '' }}">
                    <a class='sidebar-link'>
                        {{-- <i class="bi bi-card-checklist"></i> --}}
                        <i class="bi bi-list-nested"></i>
                        <span>Kategori</span>
                    </a>

                    <ul class="submenu">
                        <li class="submenu-item {{ Request::routeIs('categories.index') ? 'active' : '' }}">
                            <a href="{{ route('categories.index') }}" class="submenu-link">Daftar Kategori</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item has-sub {{ Request::is('asset.index*') ? 'active' : '' }}">
                    <a class='sidebar-link'>
                        {{-- <i class="bi bi-card-checklist"></i> --}}
                        <i class="bi bi-folder"></i>
                        <span>Aset</span>
                    </a>

                    <ul class="submenu">
                        <li class="submenu-item {{ Request::routeIs('asset.index') ? 'active' : '' }}">
                            <a href="{{ route('asset.index') }}" class="submenu-link">Daftar Aset</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item has-sub {{ Request::is('add-users*') ? 'active' : '' }}">
                    <a class='sidebar-link'>
                        <i class="bi bi-card-checklist"></i>
                        <span>Pengguna</span>
                    </a>

                    <ul class="submenu">
                        <li class="submenu-item {{ Request::routeIs('add-users.index') ? 'active' : '' }}">
                            <a href="{{ route('add-users.index') }}" class="submenu-link">Daftar Pengguna</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item {{ Request::routeIs('profile.index') ? 'active' : '' }}">
                    <a href="{{ route('profile.index') }}" class='sidebar-link'>
                        <i class="bi bi-person-circle"></i>
                        <span>Profile</span>
                    </a>
                </li>
            @endif

            @if (auth()->user()->role->name == 'user')
                <li class="sidebar-item has-sub {{ Request::is('cashs.index.owner*') ? 'active' : '' }}">
                    <a class='sidebar-link'>
                        <i class="bi bi-cash"></i>
                        <span>Kas</span>
                    </a>

                    <ul class="submenu">
                        <li class="submenu-item {{ Request::routeIs('cashs.index.owner') ? 'active' : '' }}">
                            <a href="{{ route('cashs.index.owner') }}" class="submenu-link">Daftar Kas Masuk</a>
                        </li>
                        <li class="submenu-item {{ Request::routeIs('cashs-out.index.owner') ? 'active' : '' }}">
                            <a href="{{ route('cashs-out.index.owner') }}" class="submenu-link">Daftar Kas Keluar</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item has-sub {{ Request::is('asset.index*') ? 'active' : '' }}">
                    <a class='sidebar-link'>
                        {{-- <i class="bi bi-card-checklist"></i> --}}
                        <i class="bi bi-folder"></i>
                        <span>Aset</span>
                    </a>

                    <ul class="submenu">
                        <li class="submenu-item {{ Request::routeIs('asset.index') ? 'active' : '' }}">
                            <a href="{{ route('asset.index') }}" class="submenu-link">Daftar Aset</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item {{ Request::routeIs('profile.index.owner') ? 'active' : '' }}">
                    <a href="{{ route('profile.index.owner') }}" class='sidebar-link'>
                        <i class="bi bi-person-circle"></i>
                        <span>Profile</span>
                    </a>
                </li>
            @endif


            <li class="sidebar-item">
                <a href="{{ route('logout') }}" class='sidebar-link'
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>

    <div class="position-absolute bottom-0 end-0 m-3">

        @include('partials.theme-switch')
    </div>

</div>
