@extends('admin.layout._template',['title' => 'Form produk kredit - Admin Panel'])

@section('content')

<form method="post" action="{{$action == 'store' ? route('produk-kredit.store') : route('produk-kredit.update',$kreditProduk->id)}}">
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
                    <input type="hidden" name="id" id="id" value="{{old('id',isset($kreditProduk) ? $kreditProduk->id : '')}}">
                    <div class="form-group"><label>Nama</label>
                        <input required autofocus type="text" class="form-control form-control-sm" name="nama" id="nama" placeholder="" value="{{old('nama',isset($kreditProduk) ? $kreditProduk->nama : '')}}" />
                    </div>

                    <div class="form-group"><label>Bunga</label>
                        <input required type="number" step="any" class="form-control form-control-sm" name="bunga" id="bunga" placeholder="" value="{{old('bunga',isset($kreditProduk) ? $kreditProduk->bunga : '')}}" />
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