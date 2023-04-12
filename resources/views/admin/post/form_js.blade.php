
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    var base_url = '{{url('')}}';
    tinymce.init({
        selector: '#tiny',
        plugins: 'lists advlist advhr advlink',
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | image',
      });
    
    $(document).ready(function(){
        pageVal = $("#page_id").val();
        $("#page_id").select2({
            tags: true,
            tokenSeparators: [',', ' '],
        })
        $('#page_id').trigger('change.select2');

        if($("#asberita").data('flag') == 'checked') $("#asberita").trigger('click');
    })

    $(document).on('click','#asberita', function(){
        var checked = $(this).is(':checked');
        if(checked){
            $('#page_id').prop('disabled',true);
        }else{
            $('#page_id').prop('disabled',false);
        }
    })

    $('form').on('keyup','#title',function(e){
        var ket = $('#title').val().toLowerCase();
        ket = ket.replace('.','');
        ket = ket.replace(',','');
        ket = ket.replace('&','dan');
        ket = ket.replace('!','');
        ket = ket.replace(/\s/g, '-')
        
        $('#slug').val(ket);
    });

    //Tampilkan gambar setelah pilih gambar (preview)
    function preview_gambar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var preview     = '#preview';
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
    $('form').on('click','#file_from_gallery',function(e){	
        form_gambar_gallery();
        $('#FotoModal').modal('show');
    });

    function gambar_request_server(){
        $.ajax({
            //input filter
            url : 'post/gambar_gallery_request',
            type : "get",
            data : {'filter' : $('#filter').val()},
            success : function(response) {
                gambar_retrieve(JSON.parse(response))
        },
            error:function(x,e) {
            }
        });
    }

    function gambar_retrieve(data){
        var data_foto = '';
        $('#populate').empty();

        if(data[0]['message'] !== 'empty'){
            $.each(data,function(i, p){
                data_foto +=  
                    '<div class="col-lg-4 col-md-12 mb-4">'+
                    '<img style="width:100%" class="img-fluid z-depth-1" src="{{url('assets/public/post_foto/thumb/')}}'+p['pict_name']+'" alt="'+p['title']+'">'+
                        '<div class="col-md-10">'+
                        '    <h5>'+p['title']+'</h5>'+
                        '    <p>'+p['descript']+'</p>'+
                        '</div>'+
                        '<div class="col-md-2">'+
                        '<label>'+
                        '    <input type="radio" onclick="cb_pilih_gambar('+'\''+p['pict_name']+'\''+','+'\''+p['title']+'\''+','+'\''+p['descript']+'\''+')" id="cb_pilih" name="cb_pilih[]" value="'+p['pict_name']+'">'+
                        '</label>'+
                        '</div>'+
                    '</div>';
            });
            $('#populate').append(data_foto);
        }
    }

    function cb_pilih_gambar(img,title,descript){
        $('#terpilih').val(img);
        $('#terpilih_title').val(title);
        $('#terpilih_descript').val(descript);
    }
    
    $(document).on("click",('#submit_pilih'),function(e) {
        var foto            = $("#terpilih").val();
        var fotoTitle       = $("#terpilih_title").val();
        var fotoDescript    = $("#terpilih_descript").val();
        var ukuran          = $("#ukuran option:selected").val();
        var subdir          = 'thumb';

        var callby          = $('#callby').val();
        var imgLink         = base_url+'assets/public/post_foto/'+subdir+foto;
        if(callby === 'content'){
            $('.note-image-url').val(imgLink).change();
            $('.note-image-btn').attr('disabled',false);
            $('.note-image-btn').trigger('click');
            addImgDescript(imgLink,fotoTitle,fotoDescript);
        }
        if(callby === 'image'){
            $('#preview').attr('src',imgLink);
            $('#nama_gambar').val(foto);
            $('#gambar_from').val('gallery');
        }
    });


    function form_gambar_gallery(){
        $('body').append('<div class="modal fade" id="FotoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'+
                '<div class="modal-dialog modal-lg">'+
                    '<div class="modal-content">'+
                        '<div class="modal-header">'+
                            '<h4 class="modal-title" id="myModalLabel">Pilih Gambar</h4>'+
                            '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                        '</div>'+
                        '<div class="modal-body">'+
                            '<div class="row">'+
                                '<div class="col-md-4 form-group  stretch-card">'+
                                    '<input value="" type="text" id="filter" name="filter" class="form-control form-control-sm" placeholder="Pencarian...">'+
                                    '<button type="submit" class="btn btn-warning btn-fw btn-sm pl-3 pr-3" name="btn_filter"><i class="mdi mdi-magnify icon-lg"></i></button>'+
                                '</div>'+

                                '<div class="col-md-12">'+
                                    '<div class="panel panel-white">'+
                                        '<div style="min-height:150px" id="populate" class="panel-body">'+
                                                
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="modal-footer">'+
                            '<input type="hidden" id="terpilih" name="terpilih">'+
                            '<input type="hidden" id="terpilih_title" name="terpilih_title">'+
                            '<input type="hidden" id="terpilih_descript" name="terpilih_descript">'+
                            '<input type="hidden" id="callby" name="callby">'+
                            '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>'+
                            '<button type="button" id="submit_pilih" data-dismiss="modal" class="btn btn-success">Pilih</button>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>');
    }
</script>