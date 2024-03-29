@extends('layout._template',['title' => $post->title.' - BPR ADY BANYUWANGI'])
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
        @isset($getcategory)
        <li><a href="{{$getcategory[0]->tipe == 'pages' ? url($post->slug_category) : url('category/'.$post->slug_category)}}">{{$post->category}}</a></li>
        @endisset
        <li>{{$post->title}}</li>
      </ol>
    </div>
  </nav>
</div><!-- End Breadcrumbs -->

<section id="blog" class="blog">
  <div class="container" data-aos="fade-up">
    <div class="row g-5">
      
      <div class="col-lg-8">
        
          <div class="content">
            {!!$post->contents!!}
          </div><!-- End post content -->


        <!-- </article> -->
      </div>
      <div class="col-lg-4">
        @php
          if($post->features_sidebar != null){
            $sidebars = explode(",",$post->features_sidebar);
            if(count($sidebars) > 0){
              $sidebarHelper = new \app\Helpers\SidebarHelper;
              foreach($sidebars as $sb){
                echo $sidebarHelper->show($sb);
              }
            }
          }
        @endphp
        
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

        </div>
        
      </div>
    </div>
  </section>
  @endif

</main><!-- End #main -->

@endsection