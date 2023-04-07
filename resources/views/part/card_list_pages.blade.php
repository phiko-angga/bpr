
  <!-- ======= Portfolio Section ======= -->
  <section id="home_card_menu" class="home_card_menu">
    <div class="container-fluid" data-aos="fade-up">

      <div class="home_card_menu-isotope" data-aos-delay="100">

        <div class="row gy-4 home_card_menu-container">

          @isset($pages)
            @foreach($pages as $page)
            <div class="col-xl-4 col-md-6 home_card_menu-item filter-app my_col ">
              <div class="home_card_menu-wrap">
                <a href="{{url($page->slug)}}" class="">
                  <img src="{{url('img/pages-banner/'.$page->image)}}" class="img-fluid" alt="">
                </a>
                <div class="home_card_menu-info">
                  <h4><a href="{{url($page->slug)}}" title="Lihat detail">{{$page->title}}</a></h4>
                  <p>{{$page->description}}</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->
            @endforeach
          @endisset

        </div><!-- End Portfolio Container -->

      </div>

    </div>
  </section><!-- End Portfolio Section -->
