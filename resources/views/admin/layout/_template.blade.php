<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>
    @if(isset($title)){{$title}}
    @else 'Admin Panel'
    @endif
  </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link rel="stylesheet" href="/admin/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="/admin/vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="/admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="/admin/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="/admin/images/favicon.png" />
  @yield('style')

</head>

<body>
  
  <div class="container-scroller">
  <!-- ======= Header ======= -->
    
    @include('admin/layout/_navbar')
  <!-- End Header -->
  
    <div class="container-fluid page-body-wrapper">
      @include('admin/layout/_sidebar')
      
      <div class="main-panel">
        <div class="content-wrapper">
          @yield('content')
        </div>
        
        @include('admin/layout/_footer')
      </div>
    </div>

  <!-- plugins:js -->
  <script src="/admin/vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="/admin/vendors/chart.js/Chart.min.js"></script>
  <script src="/admin/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="/admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="/admin/js/off-canvas.js"></script>
  <script src="/admin/js/hoverable-collapse.js"></script>
  <script src="/admin/js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="/admin/js/dashboard.js"></script>
  <script src="/admin/js/data-table.js"></script>
  <script src="/admin/js/jquery.dataTables.js"></script>
  <script src="/admin/js/dataTables.bootstrap4.js"></script>
  <!-- End custom js for this page-->

  <script src="/admin/js/jquery.cookie.js" type="text/javascript"></script>

  @yield('script')
</body>



