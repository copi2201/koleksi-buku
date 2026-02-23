<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @yield('style-page')
</head>
<body>
    <div class="container-scroller">
        @auth
            {{-- Navigasi hanya muncul jika sudah login --}}
            @include('layouts.navbar')
            <div class="container-fluid page-body-wrapper">
                @include('layouts.sidebar')
                <div class="main-panel">
                    <div class="content-wrapper">
                        @yield('content')
                    </div>
                    @include('layouts.footer')
                </div>
            </div>
        @else
            {{-- Layout khusus halaman Login/Register --}}
            <div class="container-fluid page-body-wrapper full-page-wrapper">
                <div class="content-wrapper d-flex align-items-center auth">
                    <div class="row flex-grow">
                        <div class="col-lg-4 mx-auto">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        @endauth
    </div>

    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    @yield('javascript-page')
</body>
</html> 