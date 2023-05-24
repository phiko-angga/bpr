@extends('layout._template',['title' => 'Berita - BPR ADY BANYUWANGI'])
@section('content')

<main id="main">
<!-- ======= Breadcrumbs ======= -->
  <div class="breadcrumbs">
    <div class="page-header d-flex align-items-center" style="background-image: url('');">
      <div class="container position-relative">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-6 text-center">
            <h2>Berita</h2>
            <p></p>
          </div>
        </div>
      </div>
    </div>
    <nav>
      <div class="container">
        <ol>
          <li><a href="{{url('/')}}">Home</a></li>
          <li>Berita</li>
        </ol>
      </div>
    </nav>
  </div><!-- End Breadcrumbs -->

  <!-- ======= Blog Section ======= -->
  <section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

      <div class="row gy-4 posts-list">

      @if($posts_publish)
        @foreach($posts_publish as $post)
        <div class="col-xl-4 col-md-6">
          <article>

            <div class="post-img">
              <img src="{{url('img/post/'.$post->image)}}" alt="" class="img-fluid">
            </div>

            <p class="post-category">{{\Carbon\Carbon::parse($post->date_publish)->format('d F Y')}}</p>

            <h2 class="title">
              <a href="{{url($post->category->slug.'/'.$post->slug)}}">{{$post->title}}</a>
            </h2>
          </article>
        </div><!-- End post list item -->
        @endforeach
      @endif

      </div><!-- End blog posts list -->

      <div class="blog-pagination">
        <ul class="justify-content-center">
          <li><a href="#">1</a></li>
          <li class="active"><a href="#">2</a></li>
          <li><a href="#">3</a></li>
        </ul>
      </div><!-- End blog pagination -->

    </div>
  </section><!-- End Blog Section -->
</main><!-- End #main -->

@endsection