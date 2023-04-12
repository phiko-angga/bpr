
@isset($posts)
  <!-- ======= Berita Section ======= -->
  <div class="row gy-4">

    @foreach($posts as $post)
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
      </div>
    @endforeach

</div>
  
  @endisset
