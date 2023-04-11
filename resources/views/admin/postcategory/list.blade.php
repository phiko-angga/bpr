@extends('admin.layout._template',['title' => 'List Category Post - Admin Panel'])
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
                            <div class=" me-3"><a href="{{route('post-category.create')}}" class="btn btn-outline-primary btn-fw btn-sm">Add Category</a></div>
                            <form method="get" action="{{route('post-category.index')}}">
                                <div class=" me-3"><input value="{{isset($search) ? $search : ''}}" type="text" id="search" name="search" class="form-control form-control-sm" placeholder="Search"  autofocus></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="30px"></th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @include('admin.postcategory.list_pagination')
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
    modalConfirm.find('form').attr('action','{{url('')}}/adminpanel/post-category/'+$(this).data('id'));
    modalConfirm.find('#confirm_title').html('Delete Category Post ');
    modalConfirm.find('#confirm_titlecaption').html('Apakah anda ingin delete ');
    modalConfirm.find('#confirm_titlename').html($(this).data('name'));
    modalConfirm.find('#confirm_titlebtn').html('Delete');
    modalConfirm.find('#id').val($(this).data('id'));
    modalConfirm.modal('show');
  })

</script>
@endsection