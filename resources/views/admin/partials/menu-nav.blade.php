<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo ">
    <a href="#" class="app-brand-link">
      <span class="app-brand-logo demo">
        <img src="{{ asset('gambar-umum/logo.png') }}" width="45">
      </span>
      <span class="app-brand-text demo menu-text fw-bolder ms-2">SMKNJO</span>
    </a>
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item {{Request::is('dashboard') ? 'active' : '' }}">
      <a href="{{ url('/dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-tachometer"></i>
        <div data-i18n="Analytics">Dashboard</div>
      </a>
    </li>

    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Master</span>
    </li>
    <li class="menu-item {{Request::is('data-kehadiran') ? 'active' : '' }}">
      <a href="{{ url('/data-kehadiran') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-report"></i>
        <div data-i18n="Account Settings">Data Kehadiran</div>
      </a>
    </li>
    <li class="menu-item @if(Request::is('data-kelas') || Request::is('data-kelas/*')) active @else @endif">
      <a href="{{ url('/data-kelas') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-building-house"></i>
        <div data-i18n="Authentications">Data Kelas</div>
      </a>
    </li>
    
    <li class="menu-item {{Request::is('data-siswa') ? 'active' : '' }}">
      <a href="{{ url('/data-siswa') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-user"></i>
        <div data-i18n="Misc">Data Siswa</div>
      </a>
    </li>

    <!-- Components -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Pengaturan</span></li>
    <!-- Cards -->
    <li class="menu-item @if(Request::is('data-lokasi')) active open @else @endif">
      <a href="{{ url('/data-lokasi') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-map-pin"></i>
        <div data-i18n="Basic">Lokasi Absen</div>
      </a>
    </li>
    <!-- User interface -->
    
    <!-- Extended components -->
    <li class="menu-item {{Request::is('data-admin') ? 'active' : '' }}">
      <a href="{{ url('/data-admin') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-user-account"></i>
        <div data-i18n="Extended UI">Data Admin</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="{{ url('/logout') }}" class="menu-link">
        <i class='menu-icon tf-icons bx bx-log-out'></i>
        <div data-i18n="User interface">Keluar</div>
      </a>
    </li>

  </ul>
</aside>