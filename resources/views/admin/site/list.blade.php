@extends('admin.layout._template',['title' => 'BPR ADY - Admin Panel'])
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
                
                <form method="post" action="{{url('adminpanel/site/save')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{old('id',isset($site) ? $site->id : '')}}">
                    <div class="row">
                        <div class="col-md-8" style="padding-right:120px">
                            <h4 class="card-title" for="">Informasi Umum</h4>
                            <div class="form-group"><label>Nama website</label>
                                <input required type="text" class="form-control form-control-sm" name="nama" id="nama" placeholder="" value="{{old('nama',isset($site) ? $site->nama : '')}}" />
                            </div>
                            <div class="form-group"><label>Deskripsi Website</label>
                                <input type="text" class="form-control form-control-sm" name="deskripsi" id="deskripsi" placeholder="" value="{{old('deskripsi',isset($site) ? $site->deskripsi : '')}}" />
                            </div>
                            <div class="form-group"><label>Deskripsi Footer</label>
                                <input type="text" class="form-control form-control-sm" name="deskripsi_footer" id="deskripsi_footer" placeholder="" value="{{old('nama',isset($site) ? $site->deskripsi_footer : '')}}" />
                            </div>
                            <div class="form-group"><label>Alamat</label>
                                <input required type="text" class="form-control form-control-sm" name="alamat" id="alamat" placeholder="" value="{{old('alamat',isset($site) ? $site->alamat : '')}}" />
                            </div>

                            <h4 class="card-title mt-5" for="">Kontak</h4>
                            <div class="form-group"><label>Telp</label>
                                <input type="text" class="form-control form-control-sm" name="telp" id="telp" placeholder="" value="{{old('telp',isset($site) ? $site->telp : '')}}" />
                            </div>
                            <div class="form-group"><label>HP</label>
                                <input type="text" class="form-control form-control-sm" name="no_hp" id="no_hp" placeholder="" value="{{old('no_hp',isset($site) ? $site->no_hp : '')}}" />
                            </div>
                            <div class="form-group"><label>WA</label>
                                <input type="text" class="form-control form-control-sm" name="no_wa" id="no_wa" placeholder="" value="{{old('no_wa',isset($site) ? $site->no_wa : '')}}" />
                            </div>
                            <div class="form-group"><label>Email</label>
                                <input type="text" class="form-control form-control-sm" name="email" id="email" placeholder="" value="{{old('email',isset($site) ? $site->email : '')}}" />
                            </div>

                            <h4 class="card-title mt-5" for="">Sosial Media</h4>
                            <div class="form-group"><label>Twitter</label>
                                <input type="text" class="form-control form-control-sm" name="twitter" id="twitter" placeholder="" value="{{old('twitter',isset($site) ? $site->twitter : '')}}" />
                            </div>
                            <div class="form-group"><label>Instagram</label>
                                <input type="text" class="form-control form-control-sm" name="instagram" id="instagram" placeholder="" value="{{old('instagram',isset($site) ? $site->instagram : '')}}" />
                            </div>
                            <div class="form-group"><label>Facebook</label>
                                <input type="text" class="form-control form-control-sm" name="fb" id="fb" placeholder="" value="{{old('fb',isset($site) ? $site->fb : '')}}" />
                            </div>
                            <div class="form-group"><label>Youtube</label>
                                <input type="text" class="form-control form-control-sm" name="youtube" id="youtube" placeholder="" value="{{old('youtube',isset($site) ? $site->youtube : '')}}" />
                            </div>

                            <h4 class="card-title mt-5" for="">Lokasi</h4>
                            <div class="form-group"><label>Latitude</label>
                                <input type="text" class="form-control form-control-sm" name="latitude" id="latitude" placeholder="" value="{{old('latitude',isset($site) ? $site->latitude : '')}}" />
                            </div>
                            <div class="form-group"><label>Longitude</label>
                                <input type="text" class="form-control form-control-sm" name="longitude" id="longitude" placeholder="" value="{{old('longitude',isset($site) ? $site->longitude : '')}}" />
                            </div>
                            <div class="form-group"><label>Embed Maps</label>
                                <input type="text" class="form-control form-control-sm" name="maps" id="maps" placeholder="" value="{{old('maps',isset($site) ? $site->maps : '')}}" />
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <h4 class="card-title" for="">Logo</h4>
                            <div class="form-group">
                                <label>Logo Header</label><br>
                                <input hidden type="file" name="logo_header" data-preview="logo_header_preview" id="logo_header" accept="image/*">
                                <label for="logo_header" class="btn btn-sm btn-warning btn-fw btn-sm pr-3" style="cursor:pointer">Upload</label>

                                <div class="row" style="min-height:100px">
                                    <img id="logo_header_preview" src="{{isset($site) ? url('img/'.$site->logo_header) : ''}}" class="img-thumbnail" style="height:auto;width:100%">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Logo Footer</label><br>
                                <input hidden type="file" name="logo_footer" id="logo_footer" data-preview="logo_footer_preview" accept="image/*">
                                <label for="logo_footer" class="btn btn-sm btn-warning btn-fw btn-sm pr-3" style="cursor:pointer">Upload</label>

                                <div class="row" style="min-height:100px">
                                    <img id="logo_footer_preview" src="{{isset($site) ? url('img/'.$site->logo_footer) : ''}}" class="img-thumbnail" style="height:auto;width:100%">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Logo Favicon</label><br>
                                <input hidden type="file" name="logo_favicon" id="logo_favicon" data-preview="logo_favicon_preview" accept="image/*">
                                <label for="logo_favicon" class="btn btn-sm btn-warning btn-fw btn-sm pr-3" style="cursor:pointer">Upload</label>

                                <div class="row" style="min-height:100px">
                                    <img id="logo_favicon_preview" src="{{isset($site) ? url('img/'.$site->logo_favicon) : ''}}" class="img-thumbnail" style="height:auto;width:100%">
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-fw btn-sm">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
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
    modalConfirm.find('form').attr('action','{{url('')}}/adminpanel/pages/'+$(this).data('id'));
    modalConfirm.find('#confirm_title').html('Delete Page ');
    modalConfirm.find('#confirm_titlecaption').html('Apakah anda ingin delete ');
    modalConfirm.find('#confirm_titlename').html($(this).data('name'));
    modalConfirm.find('#confirm_titlebtn').html('Delete');
    modalConfirm.find('#id').val($(this).data('id'));
    modalConfirm.modal('show');
  })
  
    //Tampilkan gambar setelah pilih gambar (preview)
    function preview_gambar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var preview = '#'+$(input).data('preview');
                $(preview).attr('src', e.target.result);
                var fileName = e.target.name;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('form').on('change','input[type="file"]',function(e){	
        preview_gambar(this);
        $('#gambar_from').val('upload');
    });

</script>
@endsection