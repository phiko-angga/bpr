@extends('layout._template',['title' => $post->title.' - BPR ADY'])
@section('content')

<main id="main" class="post-detail">

<!-- ======= Breadcrumbs ======= -->
@if($post->jenis_post == 'info')
<div class="breadcrumbs">
  <div class="page-header d-flex align-items-center" style=" background-image: url({{url('img/post/'.$post->image)}});">
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
        <li><a href="{{url('/')}}">Home</a></li>
        <li><a href="{{url($post->slug_category)}}">{{$post->category}}</a></li>
        <li>{{$post->title}}</li>
      </ol>
    </div>
  </nav>
</div><!-- End Breadcrumbs -->

<section id="blog" class="blog">
  <div class="container" data-aos="fade-up">
    <div class="row g-5">
      
      <div class="col-lg-12">
        <!-- <article class="blog-details"> -->

          <!-- <div class="post-img">
            <img src="{{url('img/post/'.$post->image)}}" alt="" class="img-fluid">
          </div> -->

          <!-- <h2 class="title">{{$post->title}}</h2> -->

          <!-- <div class="meta-top">
            <ul>
              <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="#"><time datetime="2020-01-01">{{Carbon\Carbon::parse($post->date_publish)->format('M d, Y')}}</time></a></li>
            </ul>
          </div> -->
          <!-- End meta top -->

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

        <!-- </article> -->
      </div>
      
    </div>
  </div>
</section>
  @else
  
  <section id="blog" class="blog">
    <div class="container" data-aos="fade-up">
      <div class="row g-5">
        
        <div class="col-lg-8">
          <article class="blog-details">

            <div class="post-img">
              <img src="{{url('img/post/'.$post->image)}}" alt="" class="img-fluid">
            </div>

            <h2 class="title">{{$post->title}}</h2>

            <div class="meta-top">
              <ul>
                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="#"><time datetime="2020-01-01">{{Carbon\Carbon::parse($post->date_publish)->format('M d, Y')}}</time></a></li>
              </ul>
            </div>
            <!-- End meta top -->

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
        
        <div class="col-lg-4">

          <div class="sidebar">

            <div class="sidebar-item categories">
              <h3 class="sidebar-title">Categories</h3>
              <ul class="mt-3">
                <li><a href="#">General <span>(25)</span></a></li>
                <li><a href="#">Lifestyle <span>(12)</span></a></li>
                <li><a href="#">Travel <span>(5)</span></a></li>
                <li><a href="#">Design <span>(22)</span></a></li>
                <li><a href="#">Creative <span>(8)</span></a></li>
                <li><a href="#">Educaion <span>(14)</span></a></li>
              </ul>
            </div><!-- End sidebar categories-->

            <div class="sidebar-item recent-posts">
              <h3 class="sidebar-title">Recent Posts</h3>

              <div class="mt-3">

                <div class="post-item mt-3">
                  <img src="assets/img/blog/blog-recent-1.jpg" alt="">
                  <div>
                    <h4><a href="blog-details.html">Nihil blanditiis at in nihil autem</a></h4>
                    <time datetime="2020-01-01">Jan 1, 2020</time>
                  </div>
                </div><!-- End recent post item-->

                <div class="post-item">
                  <img src="assets/img/blog/blog-recent-2.jpg" alt="">
                  <div>
                    <h4><a href="blog-details.html">Quidem autem et impedit</a></h4>
                    <time datetime="2020-01-01">Jan 1, 2020</time>
                  </div>
                </div><!-- End recent post item-->

                <div class="post-item">
                  <img src="assets/img/blog/blog-recent-3.jpg" alt="">
                  <div>
                    <h4><a href="blog-details.html">Id quia et et ut maxime similique occaecati ut</a></h4>
                    <time datetime="2020-01-01">Jan 1, 2020</time>
                  </div>
                </div><!-- End recent post item-->

                <div class="post-item">
                  <img src="assets/img/blog/blog-recent-4.jpg" alt="">
                  <div>
                    <h4><a href="blog-details.html">Laborum corporis quo dara net para</a></h4>
                    <time datetime="2020-01-01">Jan 1, 2020</time>
                  </div>
                </div><!-- End recent post item-->

                <div class="post-item">
                  <img src="assets/img/blog/blog-recent-5.jpg" alt="">
                  <div>
                    <h4><a href="blog-details.html">Et dolores corrupti quae illo quod dolor</a></h4>
                    <time datetime="2020-01-01">Jan 1, 2020</time>
                  </div>
                </div><!-- End recent post item-->

              </div>

            </div><!-- End sidebar recent posts-->

          </div><!-- End Blog Sidebar -->

          </div>
        
      </div>
    </div>
  </section>
  @endif

</main><!-- End #main -->

@endsection