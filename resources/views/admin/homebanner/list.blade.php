@extends('admin.layout._template',['title' => 'List Home Banner - Admin Panel'])
@section('content')

<div class="row">

	<div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                
                @if($errors->any())
                <div class="form-group">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{$errors->first()}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif

                @if (\Session::has('info'))
                <div class="form-group">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Sukses!</strong> {!! \Session::get('info') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif
                
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="d-flex justify-content-between align-items-end flex-wrap">
                            <div class=" me-3"><a href="{{route('home-banner.create')}}" class="btn btn-outline-primary btn-fw btn-sm">Add Banner</a></div>
                            
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="30px"></th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Urutan tampil</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @include('admin.homebanner.list_pagination')
                    </table>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
    <div class="clearfix"></div>
</div><!-- /.row -->

@include('admin.helper.modal_confirm')

@endsection

@section('script')
<script>
    
  $('.delete_btn').click(function(e){
    e.preventDefault();
    var modalConfirm = $('#modal_confirm');
    modalConfirm.find('form').attr('action','{{url('')}}/adminpanel/home-banner/'+$(this).data('id'));
    modalConfirm.find('#confirm_title').html('Delete Banner ');
    modalConfirm.find('#confirm_titlecaption').html('Apakah anda ingin delete ');
    modalConfirm.find('#confirm_titlename').html($(this).data('name'));
    modalConfirm.find('#confirm_titlebtn').html('Delete');
    modalConfirm.find('#id').val($(this).data('id'));
    modalConfirm.modal('show');
  })

</script>
@endsection