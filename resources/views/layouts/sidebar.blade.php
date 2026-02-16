<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="nav-profile-text d-flex flex-column">
          <span class="font-weight-bold mb-2">{{ Auth::user()->name }}</span>
          <span class="text-secondary text-small">{{ ucfirst(Auth::user()->role) }}</span>
        </div>
      </a>
    </li>

    <li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
      <a class="nav-link" href="{{ url('/home') }}">
        <span class="menu-title">Dashboard</span>
        <i class="mdi mdi-home menu-icon"></i>
      </a>
    </li>

    @if(Auth::user()->role == 'admin')
    <li class="nav-item {{ Request::is('kategori*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ url('/kategori') }}">
        <span class="menu-title">Kategori</span>
        <i class="mdi mdi-format-list-bulleted menu-icon"></i>
      </a>
    </li>
    @endif

    <li class="nav-item {{ Request::is('buku*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ url('/buku') }}">
        <span class="menu-title">Buku</span>
        <i class="mdi mdi-book-open-variant menu-icon"></i>
      </a>
    </li>
  </ul>
</nav>