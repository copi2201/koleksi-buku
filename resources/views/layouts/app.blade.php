<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Koleksi Buku</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
</head>
<body>
<div class="container-scroller">

    <!-- Navbar -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo text-white" href="#">Koleksi Buku</a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <i class="mdi mdi-account"></i> {{ Auth::user()->name ?? 'User' }}
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid page-body-wrapper">

        <!-- Sidebar -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <span class="menu-title">Dashboard</span>
                        <i class="mdi mdi-home menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/kategori') }}">
                        <span class="menu-title">Kategori</span>
                        <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/buku') }}">
                        <span class="menu-title">Buku</span>
                        <i class="mdi mdi-book menu-icon"></i>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Panel -->
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>

            <!-- Footer -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
                        © {{ date('Y') }} Koleksi Buku
                    </span>
                </div>
            </footer>
        </div>

    </div>
</div>

<script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('assets/js/misc.js') }}"></script>

</body>
</html>
