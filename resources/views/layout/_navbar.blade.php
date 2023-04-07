
<header id="header" class="header d-flex align-items-center">

  <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
    <a href="index.html" class="logo d-flex align-items-center">
      <!-- Uncomment the line below if you also wish to use an image logo -->
      <img src="/img/logo-header.png" alt="">
      <h1>BPR<span> ADY</span></h1>
    </a>
    <nav id="navbar" class="navbar">
      <ul>
        @isset($menus)
          @foreach($menus as $menu)
            <li><a href="{{url($menu->link)}}">{{$menu->name}}</a></li>
          @endforeach
        @endisset
        <!-- <li><a href="#hero">Home</a></li>
        <li><a href="#services">Tabungan</a></li>
        <li><a href="#about">Deposito</a></li>
        <li><a href="#portfolio">Kredit</a></li>
        <li><a href="#team">Layanan Prioritas</a></li>
        <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
          <ul>
            <li><a href="#">Drop Down 1</a></li>
            <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
              <ul>
                <li><a href="#">Deep Drop Down 1</a></li>
                <li><a href="#">Deep Drop Down 2</a></li>
                <li><a href="#">Deep Drop Down 3</a></li>
                <li><a href="#">Deep Drop Down 4</a></li>
                <li><a href="#">Deep Drop Down 5</a></li>
              </ul>
            </li>
            <li><a href="#">Drop Down 2</a></li>
            <li><a href="#">Drop Down 3</a></li>
            <li><a href="#">Drop Down 4</a></li>
          </ul>
        </li>
        <li><a href="#contact">Contact</a></li> -->
      </ul>
    </nav><!-- .navbar -->

    <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
    <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

  </div>
</header><!-- End Header -->