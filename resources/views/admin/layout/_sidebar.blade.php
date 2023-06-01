<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item {{ Request::segment(2) == '' ? 'active' : '' }}">
      <a class="nav-link " href="{{route('admin_dashboard')}}">
        <i class="mdi mdi-view-dashboard menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    
    <li class="nav-item {{ Request::segment(2) == 'site' ? 'active' : '' }}">
      <a class="nav-link" href="{{url('adminpanel/site')}}">
        <i class="mdi mdi-web menu-icon"></i>
        <span class="menu-title">Site</span>
      </a>
    </li>

    <li class="nav-item {{ Request::segment(2) == 'menu' ? 'active' : '' }}">
      <a class="nav-link" href="{{route('menu.index')}}">
        <i class="mdi mdi-view-headline menu-icon"></i>
        <span class="menu-title">Menu</span>
      </a>
    </li>
    <li class="nav-item {{ Request::segment(2) == 'pages' ? 'active' : '' }}">
      <a class="nav-link " href="{{route('pages.index')}}">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Pages</span>
      </a>
    </li>
    <li class="nav-item {{ Request::segment(2) == 'post' ? 'active' : '' }}">
      <a class="nav-link" href="{{route('post.index')}}">
        <i class="mdi mdi-note-text menu-icon"></i>
        <span class="menu-title">Post</span>
      </a>
    </li>
    <li class="nav-item {{ Request::segment(2) == 'post_category' ? 'active' : '' }}">
      <a class="nav-link " href="{{route('post-category.index')}}">
        <i class="mdi mdi-note menu-icon"></i>
        <span class="menu-title">Post Category</span>
      </a>
    </li>
    <li class="nav-item {{ Request::segment(2) == 'home-banner' ? 'active' : '' }}">
      <a class="nav-link " href="{{route('home-banner.index')}}">
        <i class="mdi mdi-bulletin-board menu-icon"></i>
        <span class="menu-title">Home Banner</span>
      </a>
    </li>
    <li class="nav-item {{ Request::segment(2) == 'produk-kredit' ? 'active' : '' }}">
      <a class="nav-link " href="{{route('produk-kredit.index')}}">
        <i class="mdi mdi-percent menu-icon"></i>
        <span class="menu-title">Produk Kredit</span>
      </a>
    </li>
    <li class="nav-item {{ Request::segment(2) == 'pengajuan' ? 'active' : '' }}">
      <a class="nav-link " href="{{route('pengajuan.index')}}">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Pengajuan</span>
      </a>
    </li>
    <li class="nav-item {{ Request::segment(2) == 'users' ? 'active' : '' }}">
      <a class="nav-link " href="{{route('users.index')}}">
        <i class="mdi mdi-account-key menu-icon"></i>
        <span class="menu-title">Users</span>
      </a>
    </li>
  </ul>
</nav>