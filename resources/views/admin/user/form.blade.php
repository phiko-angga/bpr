@extends('admin.layout._template',['title' => 'Form User - Admin Panel'])

@section('style')
<script src="https://cdn.tiny.cloud/1/229rplzchku15yv2g5o5o4nauey7a4s4lda3esg015pxpm2e/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@endsection

@section('content')

<form method="post" action="{{$action == 'store' ? route('users.store') : route('users.update',$user->id)}}">
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
                    <input type="hidden" name="id" id="id" value="{{old('id',isset($user) ? $user->id : '')}}">
                    <div class="form-group"><label>Name</label>
                        <input required autofocus type="text" class="form-control form-control-sm" name="name" id="name" placeholder="" value="{{old('name',isset($user) ? $user->name : '')}}" />
                    </div>

                    <div class="form-group"><label>Password</label>
                        <input {{$action == 'store' ? 'required' : ''}} type="password" class="form-control form-control-sm" name="password" id="password" placeholder="" value="" />
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

        <div class="col-md-4 col-sm-12 grid-margin stretch-card">
            <div id="accordion" class="w-100">
                <div class="card mb-3">
                    <div class="card-header" id="h-terbitkan">
                        <h5 class="mb-0">
                            <button type="button" class="btn btn-sm btn-link" data-toggle="collapse" data-target="#idterbitkan" aria-expanded="true" aria-controls="idterbitkan">Action</button>
                        </h5>
                    </div>

                    <div id="idterbitkan" class="collapse show" aria-labelledby="idterbitkan" data-parent="#accordion">
                        <div class="card-body">
                            <div class="form-group">
                                <button class="btn btn-primary btn-fw btn-sm pr-3" type="submit" name="submit" value="save">Save</button>
                            </div>
                            
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>
@endsection
