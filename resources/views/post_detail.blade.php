@extends('layout._template',['title' => $post->title])
@section('content')

<main id="main">

<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs">
  <div class="page-header d-flex align-items-center" style="background-size:cover; background-image: url({{url('img/cta-bg.jpg')}});">
    <div class="container position-relative">
      <div class="row d-flex">
        <div class="col-lg-6 text-left">
          <h2>{{$post->title}}</h2>
          <p>{{$post->description}}</p>
        </div>
      </div>
    </div>
  </div>
  
  <!-- <div style="
      width: 100%;
      height: 347px;
      /* background: var(--color-primary); */
      background-image: linear-gradient(to right, #007aff63 , #f8f9fa00);
      position: absolute;
      top:1px;
      z-index: 0;
  "></div> -->
  <nav>
    <div class="container">
      <ol>
        <li><a href="index.html">Home</a></li>
        <li>{{$post->title}}</li>
      </ol>
    </div>
  </nav>
</div><!-- End Breadcrumbs -->

<section id="blog" class="blog">
  <div class="container" data-aos="fade-up">
    <div class="row g-5">
      
      <div class="col-lg-12">
        <article class="blog-details">

          <div class="post-img">
            <img src="{{url('img/post/'.$post->image)}}" alt="" class="img-fluid">
          </div>

          <h2 class="title">{{$post->title}}</h2>

          <div class="meta-top">
            <ul>
              <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="#"><time datetime="2020-01-01">{{Carbon\Carbon::parse($post->date_publish)->format('M d, Y')}}</time></a></li>
            </ul>
          </div><!-- End meta top -->

          <div class="content">
            {!!$post->contents!!}
          </div><!-- End post content -->

          <div hidden class="meta-bottom">
            <i class="bi bi-folder"></i>
            <ul class="cats">
              <li><a href="#">Business</a></li>
            </ul>

            <i class="bi bi-tags"></i>
            <ul hidden class="tags">
              <li><a href="#">Creative</a></li>
              <li><a href="#">Tips</a></li>
              <li><a href="#">Marketing</a></li>
            </ul>
          </div><!-- End meta bottom -->

        </article>
      </div>
      
    </div>
  </div>
</section>

</main><!-- End #main -->

@endsection