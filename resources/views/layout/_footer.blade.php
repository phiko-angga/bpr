
<footer id="footer" class="footer">

<div class="container">
  <div class="row gy-4">
    <div class="col-lg-5 col-md-12 footer-info">
      <a href="index.html" class="logo d-flex align-items-center">
        <span style="margin-right: auto;margin-left: auto;">
          <img style="width: 180px;height: auto; max-height:unset" src="{{isset($site) ? '/img/'.$site->logo_footer : '#'}}" alt="">
        </span>
      </a>
      <p class="text-center">{{isset($site) ? $site->deskripsi_footer : ''}}</p>
      <div class="social-links d-flex justify-content-center mt-4">
        <a href="{{isset($site) ? $site->twitter : '#'}}" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="{{isset($site) ? $site->fb : '#'}}" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="{{isset($site) ? $site->instagram : '#'}}" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="{{isset($site) ? $site->youtube : '#'}}" class="youtube"><i class="bi bi-youtube"></i></a>
      </div>
    </div>

    <div class="col-lg-2 col-6 footer-links">
      <h4>Tabungan</h4>
      <ul>
        @isset($tabungan)
          @foreach($tabungan as $t)
            <li><a href="{{url($t->slug_category.'/'.$t->slug)}}">{{$t->title}}</a></li>
          @endforeach
        @endisset
      </ul>
    </div>

    <div class="col-lg-2 col-6 footer-links">
      <h4>Kredit</h4>
      <ul>
        @isset($kredit)
          @foreach($kredit as $k)
            <li><a href="{{url($k->slug_category.'/'.$k->slug)}}">{{$k->title}}</a></li>
          @endforeach
        @endisset
      </ul>
    </div>

    <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
      <h4>Hubungi Kami</h4>
      <p>
        {{isset($site) ? $site->alamat : ''}}
        <br><br><strong>Telp:</strong> {{isset($site) ? $site->telp : ''}}<br>
        <!-- <strong>Email:</strong> info@example.com<br> -->
      </p>

    </div>

  </div>
</div>

<div class="container mt-4">
  <div class="copyright">
    &copy; Copyright <strong><span>BPRADY</span></strong>. All Rights Reserved
  </div>
  <div class="credits">
    <!-- All the links in the footer should remain intact. -->
    <!-- You can delete the links only if you purchased the pro version. -->
    <!-- Licensing information: https://bootstrapmade.com/license/ -->
    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/impact-bootstrap-business-website-template/ -->
    Designed by <a href="https://bpradybanyuwangi.com/">Bpr Ady Banyuwangi</a>
  </div>
</div>

</footer><!-- End Footer -->