@extends('layout._template',['title' => 'Page Not Found'])
@section('content')

<main id="main">

<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs">
  <div class="page-header d-flex align-items-center" style="background-size:cover; background-image: url({{url('img/breadcrumbs-bg.jpg')}});">
    <div class="container position-relative">
      <div class="row d-flex">
        <div class="col-lg-6 text-left">
          <h2>Halaman tidak ditemukan</h2>
          <p>Maaf, halaman yang anda cari tidak ditemukan atau belum tersedia.</p>
        </div>
      </div>
    </div>
  </div>
  
</div><!-- End Breadcrumbs -->

</main><!-- End #main -->

@endsection