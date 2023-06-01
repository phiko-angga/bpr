
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    var base_url = '{{url('')}}';

    $(document).ready(function(){
        $("#page_id").select2({
            "placeholder": "Pilih page..."
        });
        refertopage_click("#refertopage");
    })

    $(document).on('click','#refertopage',function(){
        refertopage_click(this);
    })

    function refertopage_click(el){
        if ($(el).is(":checked") == true){
            $("#page_id").attr('disabled',false);
            $("#name").attr('readonly',true);
            $("#link").attr('readonly',true);
        }else{
            $("#page_id").attr('disabled',true);
            $("#name").attr('readonly',false);
            $("#link").attr('readonly',false);
        }
    }

    $(document).on('change','#page_id',function(){
        let page = $(this).find('option:selected').data('page');
        console.log(page);
        $("#name").val(page.title);
        $("#link").val(page.slug);
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

    $('form').on('change','input[type="file"]',function(e){	
        preview_gambar(this);
        $('#gambar_from').val('upload');
    });
    $('form').on('click','#file_from_gallery',function(e){	
        form_gambar_gallery();
        $('#FotoModal').modal('show');
    });

</script>