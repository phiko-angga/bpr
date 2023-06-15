
@isset($postcategories)
  <!-- ======= Portfolio Section ======= -->
  <section id="home_card_menu" class="home_card_menu">
    <div class="container-fluid" data-aos="fade-up">

      <div class="home_card_menu-isotope" data-aos-delay="100">

        <div class="row gy-4 home_card_menu-container">

            @foreach($postcategories as $category)
            <div class="col-xl-4 col-md-6 home_card_menu-item filter-app my_col ">
              <div class="home_card_menu-wrap">
                <a href="{{url('category/'.$category->slug)}}" class="">
                  <img src="{{url('img/pages-banner/'.$category->image)}}" class="img-fluid" alt="">
                </a>
                <div class="home_card_menu-info">
                  <h4 class="p-0"><a href="{{url('category/'.$category->slug)}}" title="Lihat detail">{{$category->name}}</a></h4>
                  <!-- <p>{{Str::limit($category->description, 100, '...')}}</p> -->
                </div>
              </div>
            </div><!-- End Portfolio Item -->
            @endforeach

        </div><!-- End Portfolio Container -->

      </div>

    </div>
  </section><!-- End Portfolio Section -->
  
  @endisset
