
<!-- ======= Header ======= -->
<section id="topbar" class="topbar d-flex align-items-center">
  <div class="container d-flex justify-content-center justify-content-md-between">
    <div class="contact-info d-flex align-items-center">
      <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:{{isset($site) ? $site->email : '#'}}">{{isset($site) ? $site->email : ''}}</a></i>
      <i class="bi bi-phone d-flex align-items-center ms-4"><span>{{isset($site) ? $site->telp : ''}}</span></i>
    </div>
    <div class="social-links d-none d-md-flex align-items-center">
      <a href="{{isset($site) ? $site->twitter : '#'}}" class="twitter"><i class="bi bi-twitter"></i></a>
      <a href="{{isset($site) ? $site->fb : '#'}}" class="facebook"><i class="bi bi-facebook"></i></a>
      <a href="{{isset($site) ? $site->instagram : '#'}}" class="instagram"><i class="bi bi-instagram"></i></a>
      <a href="{{isset($site) ? $site->youtube : '#'}}" class="youtube"><i class="bi bi-youtube"></i></i></a>
    </div>
  </div>
</section><!-- End Top Bar -->
