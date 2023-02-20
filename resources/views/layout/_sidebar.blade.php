@php
  $config = App\Configuration::first();
@endphp

<nav class="sidebar sidebar-offcanvas d-print-none" id="sidebar">
  <ul class="nav">

    <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
      <a class="nav-link" href="{{url('/')}}">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">Beranda</span>
      </a>
    </li>

    <li class="nav-item {{ Request::segment(1) == 'transaksi' ? 'active' : '' }}">
      <a class="nav-link" data-toggle="collapse" href="#transaksi" aria-expanded="{{ Request::segment(1) == 'transaksi' ? 'true' : 'false' }}" aria-controls="transaksi">
        <i class="mdi mdi-pencil-box menu-icon"></i>
        <span class="menu-title">Transaksi</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ Request::segment(1) == 'transaksi' ? 'show' : '' }}" id="transaksi">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link {{ Request::is('transaksi/pembelian') ? 'active' : '' }}" href="{{url('transaksi/pembelian')}}">
              <i class="mdi mdi-cart-plus menu-icon"></i>
              <span class="menu-title">Pembelian</span>
          </a></li>
          <li class="nav-item"> <a class="nav-link {{ Request::is('transaksi/penjualan') ? 'active' : '' }}" href="{{url('/transaksi/penjualan')}}">
              <i class="mdi mdi-cart-outline menu-icon"></i>
              <span class="menu-title">Penjualan</span>
          </a></li>
          <li class="nav-item"> <a class="nav-link {{ Request::is('transaksi/retur-penjualan') ? 'active' : '' }}" href="{{url('/transaksi/retur-penjualan')}}">
              <i class="mdi mdi-cart-off menu-icon"></i>
              <span class="menu-title">Retur Penjualan</span>
          </a></li>
          <li class="nav-item"> <a class="nav-link {{ Request::is('transaksi/stok-opname') ? 'active' : '' }}" href="{{url('/transaksi/stok-opname')}}">
              <i class="mdi mdi-stethoscope menu-icon"></i>
              <span class="menu-title">Stok Opname</span>
          </a></li>
        </ul>
      </div>
    </li>
    
    <li class="nav-item {{ Request::segment(1) == 'master' ? 'active' : '' }}">
      <a class="nav-link" data-toggle="collapse" href="#master" aria-expanded="{{ Request::segment(1) == 'master' ? 'true' : 'false' }}" aria-controls="master">
        <i class="mdi mdi-checkbox-multiple-marked-outline menu-icon"></i>
        <span class="menu-title">Data Master</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ Request::segment(1) == 'master' ? 'show' : '' }}" id="master">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('master/barang') ? 'active' : '' }}" href="{{url('master/barang')}}">
              <i class="mdi mdi-shape-plus menu-icon"></i>
              <span class="menu-title">Barang</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('master/merek-barang') ? 'active' : '' }}" href="{{url('master/merek-barang')}}">
              <i class="mdi mdi-shape-plus menu-icon"></i>
              <span class="menu-title">Merek Barang</span>
            </a>
          </li>
          <li class="d-none nav-item">
            <a class="nav-link {{ Request::is('master/diskon-pelanggan') ? 'active' : '' }}" href="{{url('master/diskon-pelanggan')}}">
              <i class="mdi mdi-account-star menu-icon"></i>
              <span class="menu-title">Diskon Pelanggan</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('master/diskon-tipe-pelanggan') ? 'active' : '' }}" href="{{url('master/diskon-tipe-pelanggan')}}">
              <i class="mdi mdi-account-star menu-icon"></i>
              <span class="menu-title">Diskon Tipe Pelanggan</span>
            </a>
          </li>
          <li style="display:none" class="nav-item">
            <a class="nav-link {{ Request::is('master/stok-awal') ? 'active' : '' }}" href="{{url('master/stok-awal')}}">
              <i class="mdi mdi-bitbucket menu-icon"></i>
              <span class="menu-title">Stok Awal</span>
            </a>
          </li>
          
          @if($config->multi_satuan == '1')
            @if(in_array(Session::get('level'),['admin','owner']))
            <li class="nav-item">
              <a class="nav-link {{ Request::is('master/satuan') ? 'active' : '' }}" href="{{url('master/satuan')}}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Satuan & Harga jual</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Request::is('master/hargajual-jumlah') ? 'active' : '' }}" href="{{url('master/hargajual-jumlah')}}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Harga jual/Jumlah</span>
              </a>
            </li>
            @endif
          @else
            <li class="nav-item">
              <a class="nav-link {{ Request::is('master/hargajual-jumlah') ? 'active' : '' }}" href="{{url('master/hargajual-jumlah')}}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Harga jual/Jumlah</span>
              </a>
            </li>
          @endif

          <li class="nav-item">
            <a class="nav-link {{ Request::is('master/pelanggan') ? 'active' : '' }}" href="{{url('master/pelanggan')}}">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">Pelanggan</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('master/supplier') ? 'active' : '' }}" href="{{url('master/supplier')}}">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">Supplier</span>
            </a>
          </li>
          @if(in_array(Session::get('level'),['admin','owner']))
          <li class="nav-item">
            <a class="nav-link {{ Request::is('master/user') ? 'active' : '' }}" href="{{url('master/user')}}">
              <i class="mdi mdi-account-key menu-icon"></i>
              <span class="menu-title">User</span>
            </a>
          </li>
          @endif
        </ul>
      </div>
    </li>

    @if(in_array(Session::get('level'),['admin','owner']))
    <li class="nav-item {{ Request::segment(1) == 'laporan' ? 'active' : '' }}">
      <a class="nav-link" data-toggle="collapse" href="#laporan" aria-expanded="{{ Request::segment(1) == 'laporan' ? 'true' : 'false' }}" aria-controls="laporan">
        <i class="mdi mdi-file-chart menu-icon"></i>
        <span class="menu-title">Laporan</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ Request::segment(1) == 'laporan' ? 'show' : '' }}" id="laporan">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link {{ Request::is('laporan/persediaan') ? 'active' : '' }}" href="{{url('/laporan/persediaan')}}">Persediaan</a></li>
          <li class="nav-item"> <a class="nav-link {{ Request::is('laporan/top-penjualan') ? 'active' : '' }}" href="{{url('/laporan/top-penjualan')}}">Barang Terlaris</a></li>
          <li class="nav-item"> <a class="nav-link {{ Request::is('laporan/aktifitas-stok') ? 'active' : '' }}" href="{{url('/laporan/aktifitas-stok')}}">Aktifitas Stok Barang</a></li>
          <li class="nav-item"> <a class="nav-link {{ Request::is('laporan/hargajual') ? 'active' : '' }}" href="{{url('/laporan/hargajual')}}">Harga Barang</a></li>
          <li class="nav-item"> <a class="nav-link {{ Request::is('laporan/penjualan/per-tanggal') ? 'active' : '' }}" href="{{url('/laporan/penjualan/per-tanggal')}}">Penjualan per Tanggal</a></li>
          <li class="nav-item"> <a class="nav-link {{ Request::is('laporan/penjualan/harian') ? 'active' : '' }}" href="{{url('/laporan/penjualan/harian')}}">Penjualan Harian per Bulan</a></li>
          <li class="nav-item"> <a class="nav-link {{ Request::is('laporan/penjualan/bulanan') ? 'active' : '' }}" href="{{url('/laporan/penjualan/bulanan')}}">Penjualan Bulanan per Tahun</a></li>
          <li class="nav-item"> <a class="nav-link {{ Request::is('laporan/pembelian/per-tanggal') ? 'active' : '' }}" href="{{url('laporan/pembelian/per-tanggal')}}">Pembelian per Tanggal</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item {{ Request::segment(1) == 'tools' ? 'active' : '' }}">
      <a class="nav-link" data-toggle="collapse" href="#tools" aria-expanded="{{ Request::segment(1) == 'tools' ? 'true' : 'false' }}" aria-controls="tools">
        <i class="mdi mdi-settings menu-icon"></i>
        <span class="menu-title">Tools</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ Request::segment(1) == 'tools' ? 'show' : '' }}" id="tools">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link {{ Request::is('tools/backup') ? 'active' : '' }}" href="{{url('/tools/backup')}}">Backup </a></li>
          <!-- <li class="nav-item"> <a class="nav-link" href="{{url('/tools/restore')}}">Restore </a></li> -->
        </ul>
      </div>
    </li>

    @elseif(in_array(Session::get('level'),['kasir']))
    <li class="nav-item {{ Request::segment(1) == 'laporan' ? 'active' : '' }}">
      <a class="nav-link" data-toggle="collapse" href="#laporan" aria-expanded="{{ Request::segment(1) == 'laporan' ? 'true' : 'false' }}" aria-controls="laporan">
        <i class="mdi mdi-file-chart menu-icon"></i>
        <span class="menu-title">Laporan</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ Request::segment(1) == 'laporan' ? 'show' : '' }}" id="laporan">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link {{ Request::is('laporan/persediaan') ? 'active' : '' }}" href="{{url('/laporan/persediaan')}}">Persediaan</a></li>
          <li class="nav-item"> <a class="nav-link {{ Request::is('laporan/hargajual') ? 'active' : '' }}" href="{{url('/laporan/hargajual')}}">Harga Barang</a></li>
          <li class="nav-item"> <a class="nav-link {{ Request::is('laporan/top-penjualan') ? 'active' : '' }}" href="{{url('/laporan/top-penjualan')}}">Barang Terlaris</a></li>
          <li class="nav-item"> <a class="nav-link {{ Request::is('laporan/aktifitas-stok') ? 'active' : '' }}" href="{{url('/laporan/aktifitas-stok')}}">Aktifitas Stok Barang</a></li>
        </ul>
      </div>
    </li>
    @endif

  </ul>
</nav>