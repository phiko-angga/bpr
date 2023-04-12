
<section id="hero" class="hero" style="height:100%">
    <div class="container-fluid position-relative" style="padding-left:0;padding-right:0">
        <div class="row gy-5" data-aos="fade-in">
            <div style="margin-top:0" id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  
                    @isset($banner)
                        @foreach($banner as $key => $img)
                          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$key}}" {{$key == 0 ? "class=active aria-current=true" : ''}}  aria-label="{{$img->description}}"></button>
                        @endforeach
                    @endisset
                </div>
                
                <div class="carousel-inner">
                @isset($banner)
                    @foreach($banner as $key => $img)
                      <div class="carousel-item {{$key == 0 ? 'active' : ''}}" data-bs-interval="{{($key+1) * 3000}}">
                          <img src="/img/banner/{{$img->image}}" class="d-block w-100" alt="{{$img->description}}">
                      </div>
                    @endforeach
                @endisset
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</section>

