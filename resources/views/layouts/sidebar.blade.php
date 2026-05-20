<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">

    @auth

    {{-- PROFILE --}}
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">

        <div class="nav-profile-image">
          <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile">
          <span class="login-status online"></span>
        </div>

        <div class="nav-profile-text d-flex flex-column">
          <span class="font-weight-bold mb-2">
            {{ Auth::user()->name }}
          </span>

          <span class="text-secondary text-small">
            {{ ucfirst(Auth::user()->role ?? 'User') }}
          </span>
        </div>

        <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>

      </a>
    </li>

    @endauth


    {{-- DASHBOARD --}}
    <li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
      <a class="nav-link" href="{{ url('/home') }}">
        <span class="menu-title">Dashboard</span>
        <i class="mdi mdi-home menu-icon"></i>
      </a>
    </li>


    {{-- ================= ADMIN ONLY ================= --}}
    @auth
    @if(Auth::user()->role == 'admin')

    {{-- KATEGORI --}}
    <li class="nav-item {{ Request::is('kategori*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ url('/kategori') }}">
        <span class="menu-title">Kategori</span>
        <i class="mdi mdi-format-list-bulleted menu-icon"></i>
      </a>
    </li>

    {{-- BUKU --}}
    <li class="nav-item {{ Request::is('buku*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ url('/buku') }}">
        <span class="menu-title">Buku</span>
        <i class="mdi mdi-book-open-variant menu-icon"></i>
      </a>
    </li>

    {{-- TAG HARGA --}}
    <li class="nav-item">
      <a class="nav-link" href="{{ route('barang.index') }}">
        <span class="menu-title">tag harga</span>
        <i class="mdi mdi-tag menu-icon"></i>
      </a>
    </li>

    @endif
    @endauth


    {{-- ================= SCANNER GLOBAL ================= --}}
    <li class="nav-item {{ Request::is('scanner-barang*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ url('/scanner-barang') }}">
        <span class="menu-title">Scanner Barang</span>
        <i class="mdi mdi-barcode-scan menu-icon"></i>
      </a>
    </li>


    {{-- ================= VENDOR ONLY ================= --}}
    @auth
    @if(Auth::user()->role == 'vendor')

    {{-- LIHAT MENU --}}
    <li class="nav-item">
      <a class="nav-link" href="{{ route('vendor.menu.index') }}">
        <span class="menu-title">Lihat Menu</span>
        <i class="mdi mdi-food menu-icon"></i>
      </a>
    </li>

    {{-- TAMBAH MENU --}}
    <li class="nav-item">
      <a class="nav-link" href="{{ route('vendor.menu.create') }}">
        <span class="menu-title">Tambah Menu</span>
        <i class="mdi mdi-plus-box menu-icon"></i>
      </a>
    </li>

    {{-- SCAN STRUK --}}
    <li class="nav-item">
      <a class="nav-link" href="{{ url('/scanner-vendor') }}">
        <span class="menu-title">Scan Barcode Struk</span>
        <i class="mdi mdi-qrcode-scan menu-icon"></i>
      </a>
    </li>

    @endif
    @endauth


    {{-- ================= ADMIN FITUR ================= --}}
    @auth
    @if(Auth::user()->role == 'admin')

    {{-- DOKUMEN --}}
    <li class="nav-item {{ Request::is('cetak*') ? 'active' : '' }}">

      <a class="nav-link"
         data-bs-toggle="collapse"
         href="#ui-pdf"
         aria-expanded="{{ Request::is('cetak*') ? 'true' : 'false' }}"
         aria-controls="ui-pdf">

        <span class="menu-title">Dokumen</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-file-pdf menu-icon"></i>

      </a>

      <div class="collapse {{ Request::is('cetak*') ? 'show' : '' }}" id="ui-pdf">

        <ul class="nav flex-column sub-menu">

          <li class="nav-item">
            <a class="nav-link"
               href="{{ route('sertifikat.cetak') }}"
               target="_blank">
              Sertifikat
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link"
               href="{{ route('undangan.cetak') }}"
               target="_blank">
              Undangan
            </a>
          </li>

        </ul>

      </div>

    </li>


    {{-- MODUL 4 --}}
    <li class="nav-item">

      <a class="nav-link"
         data-bs-toggle="collapse"
         href="#modul-4"
         aria-expanded="false"
         aria-controls="modul-4">

        <span class="menu-title">Modul 4</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-layers menu-icon"></i>

      </a>

      <div class="collapse" id="modul-4">

        <ul class="nav flex-column sub-menu">

          <li class="nav-item">
            <a class="nav-link" href="{{ route('modul4.html') }}">
              Search Barang
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('modul4.select') }}">
              Select & Select2
            </a>
          </li>

        </ul>

      </div>

    </li>


    {{-- MODUL 5 --}}
    <li class="nav-item {{ Request::is('modul5*') ? 'active' : '' }}">

      <a class="nav-link"
         data-bs-toggle="collapse"
         href="#modul-5"
         aria-expanded="{{ Request::is('modul5*') ? 'true' : 'false' }}"
         aria-controls="modul-5">

        <span class="menu-title">Modul 5</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-code-tags menu-icon"></i>

      </a>

      <div class="collapse {{ Request::is('modul5*') ? 'show' : '' }}" id="modul-5">

        <ul class="nav flex-column sub-menu">

          <li class="nav-item">
            <a class="nav-link {{ Request::is('modul5/wilayah') ? 'active' : '' }}"
               href="{{ route('modul5.wilayah') }}">
              Wilayah Indonesia
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('modul5/pos') ? 'active' : '' }}"
               href="{{ route('modul5.pos') }}">
              Halaman Kasir (POS)
            </a>
          </li>

        </ul>

      </div>

    </li>


    {{-- MODUL 6 --}}
    <li class="nav-item {{ Request::is('modul6*') ? 'active' : '' }}">

      <a class="nav-link"
         data-bs-toggle="collapse"
         href="#modul-6"
         aria-expanded="{{ Request::is('modul6*') ? 'true' : 'false' }}"
         aria-controls="modul-6">

        <span class="menu-title">Modul 6</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-store menu-icon"></i>

      </a>

      <div class="collapse {{ Request::is('modul6*') ? 'show' : '' }}" id="modul-6">

        <ul class="nav flex-column sub-menu">

          <li class="nav-item">
            <a class="nav-link {{ Request::is('modul6') ? 'active' : '' }}"
               href="{{ route('modul6.admin.index') }}">
              Dashboard Kantin
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('modul6/vendor*') ? 'active' : '' }}"
               href="{{ route('modul6.vendor.index') }}">
              Data Vendor
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('modul6/menu*') ? 'active' : '' }}"
               href="{{ route('modul6.menu.index') }}">
              Data Menu
            </a>
          </li>

        </ul>

      </div>

    </li>


    {{-- CUSTOMER --}}
    <li class="nav-item {{ Request::is('customer-camera*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ url('/customer-camera') }}">
        <span class="menu-title">Customer</span>
        <i class="mdi mdi-camera menu-icon"></i>
      </a>
    </li>

    @endif
    @endauth

  </ul>
</nav>