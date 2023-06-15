@extends('admin.layout._template',['title' => 'Form Category Post - Admin Panel'])

@section('style')
<script src="https://cdn.tiny.cloud/1/229rplzchku15yv2g5o5o4nauey7a4s4lda3esg015pxpm2e/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

<form method="post" enctype="multipart/form-data" action="{{$action == 'store' ? route('post-category.store') : route('post-category.update',$category->id)}}">
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
                    <input type="hidden" name="id" id="id" value="{{old('id',isset($category) ? $category->id : '')}}">
                    <div class="form-group"><label>Name</label>
                        <input required autofocus type="text" class="form-control form-control-sm" name="name" id="name" placeholder="" value="{{old('name',isset($category) ? $category->name : '')}}" />
                    </div>

                    <div class="form-group"><label>Slug</label>
                        <input required type="text" class="form-control form-control-sm" name="slug" id="slug" placeholder="" value="{{old('slug',isset($category) ? $category->slug : '')}}" />
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

        <div class="col-md-4 col-sm-12 grid-margin stretch-card">
            <div id="accordion" class="w-100">
                <div class="card mb-3">
                    <div class="card-header" id="h-terbitkan">
                        <h5 class="mb-0">
                            <button type="button" class="btn btn-sm btn-link" data-toggle="collapse" data-target="#idterbitkan" aria-expanded="true" aria-controls="idterbitkan">TERBITKAN</button>
                        </h5>
                    </div>

                    <div id="idterbitkan" class="collapse show" aria-labelledby="idterbitkan" data-parent="#accordion">
                        <div class="card-body">
                            <div class="form-group">
                                <button class="btn btn-warning btn-fw btn-sm pr-3" type="submit" name="submit" value="draft">Simpan Draft</button>
                                <button class="btn btn-primary btn-fw btn-sm pr-3" type="submit" name="submit" value="publish">Publish</button>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header" id="h-infolain">
                        <h5 class="mb-0">
                            <button type="button" class="btn btn-sm btn-link" data-toggle="collapse" data-target="#infolain" aria-expanded="true" aria-controls="infolain">LAIN - LAIN</button>
                        </h5>
                    </div>

                    <div id="infolain" class="collapse show" aria-labelledby="infolain" data-parent="#accordion">
                        <div class="card-body">

                            <div class="form-group"><label>Tampilkan di Pages</label>
                                <select name="page_id[]" id="page_id" value="" class="form-control form-control-sm" multiple="multiple">
                                    @if($pages)
                                        @php $post_pages = []; @endphp
                                        @if(isset($category) && isset($category->pages))
                                            @php $post_pages = array_column($category->pages->toArray(),'page_id'); @endphp
                                        @endif
                                        @foreach($pages as $page)
                                            <option {{isset($post_pages) ? (in_array($page->id,$post_pages) ? 'selected' : '') : ''}} value="{{$page->id}}">{{$page->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div hidden class="form-group"><label>Tags</label>
                                <input type="text" multiple class="tags form-control form-control-sm"
                                    data-user-option-allowed="true"
                                    data-url="{{route('dd_get_category')}}"
                                    data-load-once="true"
                                    name="tags[]"/>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header" id="h-gambar">
                        <h5 class="mb-0">
                            <button type="button" class="btn btn-sm btn-link" data-toggle="collapse" data-target="#gambar" aria-expanded="true" aria-controls="infolain">UPLOAD GAMBAR/THUMB</button>
                        </h5>
                    </div>

                    <div id="gambar" class="collapse show" aria-labelledby="gambar" data-parent="#accordion">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Gambar Banner</label><br>
                                <input hidden type="file" name="file" id="file" accept="image/*">
                                <label for="file" class="btn btn-sm btn-primary btn-fw btn-sm pr-3" style="cursor:pointer">Upload</label>
                                <label id="file_from_gallery" class="btn btn-sm btn-primary btn-fw btn-sm pr-3" style="cursor:pointer">From gallery</label>

                                <div class="row">
                                    <img id="preview" src="{{isset($category) ? url('img/pages-banner/'.$category->image) : ''}}" class="img-thumbnail" style="height:190px;width:100%">
                                    <input type="hidden" name="gambar_from" id="gambar_from">
                                    <input type="hidden" name="nama_gambar" id="nama_gambar">
                                </div>
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
    @include('admin/postcategory/form_js')
@endsection