<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    
    @auth
   
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="nav-profile-image">
          <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile">
          <span class="login-status online"></span>
        </div>
        <div class="nav-profile-text d-flex flex-column">
          <span class="font-weight-bold mb-2">{{ Auth::user()->name }}</span>
      
          <span class="text-secondary text-small">{{ ucfirst(Auth::user()->role ?? 'User') }}</span>
        </div>
        <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
      </a>
    </li>
    @endauth

    <li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
      <a class="nav-link" href="{{ url('/home') }}">
        <span class="menu-title">Dashboard</span>
        <i class="mdi mdi-home menu-icon"></i>
      </a>
    </li>

    @auth
      @if(Auth::user()->role == 'admin')
      <li class="nav-item {{ Request::is('kategori*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/kategori') }}">
          <span class="menu-title">Kategori</span>
          <i class="mdi mdi-format-list-bulleted menu-icon"></i>
        </a>
      </li>
      @endif
    @endauth

    {{-- Menu Buku --}}
    <li class="nav-item {{ Request::is('buku*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ url('/buku') }}">
        <span class="menu-title">Buku</span>
        <i class="mdi mdi-book-open-variant menu-icon"></i>
      </a>
    </li>

    @auth
      @if(Auth::user()->role == 'admin')
      <li class="nav-item {{ Request::is('cetak*') ? 'active' : '' }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-pdf" aria-expanded="{{ Request::is('cetak*') ? 'true' : 'false' }}" aria-controls="ui-pdf">
          <span class="menu-title">Dokumen</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-file-pdf menu-icon"></i>
        </a>
        <div class="collapse {{ Request::is('cetak*') ? 'show' : '' }}" id="ui-pdf">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> 
              <a class="nav-link" href="{{ route('sertifikat.cetak') }}" target="_blank">Sertifikat</a> 
            </li>
            <li class="nav-item"> 
              <a class="nav-link" href="{{ route('undangan.cetak') }}" target="_blank">Undangan </a> 
            </li>
          </ul>
        </div>
      </li>
      @endif
    @endauth

  </ul>
</nav>