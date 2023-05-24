@extends('layout._template',['title' => $page->title.' - BPR ADY BANYUWANGI'])
@section('content')

<main id="main" class="pages">

<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs">
  <div class="page-header d-flex align-items-center" style="background-size:cover; background-image: url({{url('img/pages-banner/'.$page->image)}});">
    <div class="container position-relative">
      <div class="row d-flex">
        <div class="col-lg-6 text-left">
          <h2>{{$page->title}}</h2>
          <p>{{$page->description}}</p>
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
        <li>{{$page->title}}</li>
      </ol>
    </div>
  </nav>
</div><!-- End Breadcrumbs -->

<section class="sample-page">
  <div class="container" data-aos="fade-up">
    <div class="row g-5">
      <div class="col-lg-8">
    
        @include("part.card_list_post")

        {!!$page->contents!!}

      </div>
      <div class="col-lg-4">
        @php
          if($page->features_sidebar != null){
            $sidebars = explode(",",$page->features_sidebar);
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