@extends('admin.layout._template',['title' => 'BPR ADY - Admin Panel'])
@section('content')

<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="d-flex justify-content-between flex-wrap">
      <div class="d-flex align-items-end flex-wrap">
        <div class="mr-md-3 mr-xl-5">
            <h2>Selamat datang,</h2>
            <p class="mb-md-0">kelola dan analisa content website melalui Admin Panel.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body dashboard-tabs p-0">
        <ul class="nav nav-tabs px-4" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Rangkuman</a>
            </li>
        </ul>

        <div class="tab-content py-0 px-0">
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                <div class="d-flex flex-wrap justify-content-xl-between">

                    <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                        <i class="mdi mdi-file-document mr-3 icon-lg text-danger"></i>
                        <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total Post</small>
                            <h5 class="mr-2 mb-0"><?=$post?></h5>
                        </div>
                    </div>
                    <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                        <i class="mdi mdi-file-document mr-3 icon-lg text-danger"></i>
                        <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total Page</small>
                            <h5 class="mr-2 mb-0"><?=$page?></h5>
                        </div>
                    </div>
                    <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                        <i class="mdi mdi-eye me-3 icon-lg text-success"></i>
                        <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total Views</small>
                            <h5 class="mr-2 mb-0"><?=$views?></h5>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection