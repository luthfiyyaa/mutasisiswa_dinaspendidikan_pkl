<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    {{-- Custom UI --}}
    <link rel="stylesheet" href="{{ asset('css/modern.css') }}">

    <link rel="shortcut icon" href="{{ asset('admin/images/logo_baru.png') }}" type="image/x-icon">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('css')
</head>

<body>
    {{-- NAVBAR --}}
    <nav class="navbar">
        <div class="navbar-left">
            <button id="sidebarToggle" class="sidebar-toggle">
                <i class="fas fa-bars"></i>
            </button>

            <div class="logo">
                DINAS PENDIDIKAN
            </div>
        </div>

        <div class="user-menu" id="userMenu">
            <div class="user-info" id="userToggle">
                <i class="fas fa-user-circle"></i>
                <span>{{ Auth::user()->name }}</span>
                <i class="fas fa-chevron-down"></i>
            </div>

            <div class="user-dropdown" id="userDropdown">
                <a href="{{ route('admin_user.index') }}" class="dropdown-item">
                    <i class="fas fa-user"></i> Profile
                </a>

                <a href="{{ route('logout') }}" class="dropdown-item logout"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Sign Out
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                    @csrf
                </form>
            </div>
        </div>
    </nav>


    <div class="container">
        {{-- SIDEBAR --}}
        <aside class="sidebar">
            @php
                $id_user = Auth::user()->id;

                // PERBAIKAN: Sesuaikan join dengan foreign key yang benar
                $online = App\Models\MasterUserModel::join('tbl_group', 'users.group_id', '=', 'tbl_group.group_id')
                    ->where('users.id', $id_user)
                    ->value('tbl_group.group_nama');
            @endphp

            <div class="profile-section">
                <div class="profile-img">
                    <img src="{{ asset('admin/images/logo_baru.png') }}" alt="User Image">
                </div>

                <div class="profile-name">
                    {{ $online }}
                </div>

                <div class="profile-status">
                    <span class="status-dot"></span>
                    <span>Online</span>
                </div>
            </div>


            <nav class="nav-section">
                <div class="nav-title">Main Navigation</div>

                <a href="{{ url('/') }}" class="nav-item {{ $hal == 'index' ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Beranda</span>
                </a>

                {{-- PERBAIKAN: Pastikan join menggunakan kolom yang benar --}}
                @foreach(App\Models\MenuModel::join('tbl_t_user','tbl_t_user.menu_id','=','tbl_menu.menu_id')
                ->orderBy('tbl_menu.menu_id','desc')
                ->where([
                    ['tbl_menu.menu_id_parent', '=', '0'],
                    ['tbl_t_user.group_id', '=', Auth::user()->group_id],
                ])->get() as $menuItem)

                    <div class="nav-title">{{ $menuItem->menu_nama }}</div>

                    @foreach(App\Models\MenuModel::join('tbl_t_user','tbl_t_user.menu_id','=','tbl_menu.menu_id')
                    ->orderBy('tbl_menu.menu_id','asc')
                    ->where([
                        ['tbl_menu.menu_id_parent', '=', $menuItem->menu_id],
                        ['tbl_t_user.group_id', '=', Auth::user()->group_id],
                    ])->get() as $menuItemList)

                        <a href="{{ route($menuItemList->menu_link.'.index') }}"
                            class="nav-item {{ $hal == $menuItemList->menu_link ? 'active' : '' }}">
                            <i class="fas fa-circle"></i>
                            <span>{{ $menuItemList->menu_nama }}</span>
                        </a>

                    @endforeach
                @endforeach
            </nav>
        </aside>

        {{-- CONTENT --}}
        <main class="main-content">
            @yield('content')
        </main>
    </div>

    {{-- FOOTER --}}
    <footer class="footer">
        Copyright © 2026 PKL FILKOM UB
        <a href="https://dindik.trenggalekkab.go.id/">
            Dinas Pendidikan Kabupaten Trenggalek
        </a>.
        All rights reserved. | Version 2.0
    </footer>

    @yield('js')
</body>

<!-- jQuery 3 -->
<script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin/dist/js/demo.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/validator.js') }}"></script>


<script>
    const toggle = document.getElementById('userToggle');
    const dropdown = document.getElementById('userDropdown');

    toggle.addEventListener('click', function (e) {
        e.stopPropagation();
        dropdown.classList.toggle('show');
    });

    document.addEventListener('click', function () {
        dropdown.classList.remove('show');
    });

    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');

    sidebarToggle.addEventListener('click', function () {
        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('expanded');
    });
</script>
@yield('js')

<script>
$(document).ready(function () {
    $('.sidebar-menu').tree()
})
</script>

</html>