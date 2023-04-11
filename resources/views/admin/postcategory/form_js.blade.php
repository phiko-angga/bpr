
<script>
    $('form').on('keyup','#name',function(e){
        var ket = $('#name').val().toLowerCase();
        ket = ket.replace('.','');
        ket = ket.replace(',','');
        ket = ket.replace('&','dan');
        ket = ket.replace('!','');
        ket = ket.replace(/\s/g, '-')
        
        $('#slug').val(ket);
    });

</script>