@extends('admin.layout._template',['title' => 'Form Menu - Admin Panel'])

@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

<form method="post" enctype="multipart/form-data" action="{{$action == 'store' ? route('menu.store') : route('menu.update',$menu->id)}}">
    @if($action == 'update')
    <input name="_method" type="hidden" value="PUT">
    @endif
    <div class="row">
        <div class="col-md-8 col-sm-12 grid-margin stretch-card">
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

                    @if (\Session::has('success'))
                    <div class="form-group">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Sukses!</strong> {!! \Session::get('success') !!}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif

                    @csrf
                    <input type="hidden" name="id" id="id" value="{{old('id',isset($menu) ? $menu->id : '')}}">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" style="margin-left:0;cursor:pointer" {{isset($menu) ? ($menu->page_id != null ? 'checked' : '') : ''}} type="checkbox" name="refertopage" value="1" id="refertopage">
                            <label class="form-check-label text-info" for="asberita">Refer to page ?</label>
                        </div>
                        <select disabled name="page_id" id="page_id" class="form-control form-control-sm">
                            <option value="{{isset($menu) ? $menu->page_id2 : ''}}">{{isset($menu) ? $menu->page_name : ''}}</option>
                            @if($page_list)
                                @foreach($page_list as $page)
                                    <option data-page="{{json_encode($page)}}" {{isset($menu) ? ($menu->page_id == $page->id ? 'selected' : '') : ''}} value="{{$page->id}}">{{$page->title}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group"><label>Menu Name</label>
                        <input required autofocus type="text" class="form-control form-control-sm" name="name" id="name" placeholder="Menu name" value="{{old('name',isset($menu) ? $menu->name : '')}}" />
                    </div>
                    <div class="form-group"><label>Link</label>
                        <input required type="text" class="form-control form-control-sm" name="link" id="link" placeholder="" value="{{old('slug',isset($menu) ? $menu->link : '')}}" />
                    </div>
                    <div class="form-group"><label>Order</label>
                        <input required type="number" class="form-control form-control-sm" name="order" id="order" placeholder="" value="{{old('order',isset($menu) ? $menu->order : '')}}" />
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

        <div class="col-md-4 col-sm-12 grid-margin stretch-card">
            <div id="accordion" class="w-100">
                <div class="card mb-3">
                    <div class="card-header" id="h-terbitkan">
                        <h5 class="mb-0">
                            <button type="button" class="btn btn-sm btn-link" data-toggle="collapse" data-target="#idterbitkan" aria-expanded="true" aria-controls="idterbitkan">ACTION</button>
                        </h5>
                    </div>

                    <div id="idterbitkan" class="collapse show" aria-labelledby="idterbitkan" data-parent="#accordion">
                        <div class="card-body">
                            <div class="form-group">
                                <button class="btn btn-primary btn-fw btn-sm pr-3" type="submit" name="submit" value="publish">SAVE</button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
    @include('admin/menu/form_js')
@endsection