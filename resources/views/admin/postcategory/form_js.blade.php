<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    
    $(document).ready(function(){
        pageVal = $("#page_id").val();
        $("#page_id").select2({
            tags: true,
            tokenSeparators: [',', ' '],
        })
        $('#page_id').trigger('change.select2');
    })

    $('form').on('keyup','#name',function(e){
        var ket = $('#name').val().toLowerCase();
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

</script>