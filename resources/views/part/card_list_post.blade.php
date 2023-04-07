
@isset($posts)
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
                  <p>{{$post->description}}</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->
            @endforeach

        </div><!-- End Portfolio Container -->

      </div>

    </div>
  </section><!-- End Portfolio Section -->
  
  @endisset
