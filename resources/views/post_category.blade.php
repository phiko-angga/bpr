@extends('layout._template',['title' => $category->title.' - BPR ADY BANYUWANGI'])
@section('content')

<main id="main" class="pages">

<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs">
  <div class="page-header d-flex align-items-center" style="background-size:cover; background-image: url({{url('img/pages-banner/'.$category->image)}});">
    <div class="container position-relative">
      <div class="row d-flex">
        <div class="col-lg-6 text-left">
          <h2>{{$category->title}}</h2>
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
        <li>{{$category->name}}</li>
      </ol>
    </div>
  </nav>
</div><!-- End Breadcrumbs -->

<section class="sample-page">
  <div class="container" data-aos="fade-up">
    <div class="row g-5">
      <div class="col-lg-8 content">
        
      @if (isset($posts) && count($posts) > 0)
      <!-- ======= Portfolio Section ======= -->
      <section id="home_card_menu" class="home_card_menu">
        <div class="container-fluid" data-aos="fade-up">

          <div class="home_card_menu-isotope" data-aos-delay="100">

            <div class="row gy-4 home_card_menu-container">

                @foreach($posts as $post)
                <div class="col-xl-4 col-md-6 home_card_menu-item filter-app my_col ">
                  <div class="home_card_menu-wrap">
                    <a href="{{url($post->slug_category.'/'.$post->slug)}}" class="">
                      <img src="{{url('img/post/'.$post->image)}}" class="img-fluid" alt="">
                    </a>
                    <div class="home_card_menu-info">
                      <h4><a href="{{url($post->slug_category.'/'.$post->slug)}}" title="Lihat detail">{{$post->title}}</a></h4>
                      <p>{{Str::limit($post->description, 100, '...')}}</p>
                    </div>
                  </div>
                </div><!-- End Portfolio Item -->
                @endforeach

            </div><!-- End Portfolio Container -->

          </div>

        </div>
      </section><!-- End Portfolio Section -->
      
      @endif

      </div>
      <div class="col-lg-4">
        @php
          if($category->features_sidebar != null){
            $sidebars = explode(",",$category->features_sidebar);
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

</main><!-- End #main -->

@endsection
