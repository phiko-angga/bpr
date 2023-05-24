
$("#pengajuan-form").on('click','#btn_kirim',function(e){
    e.preventDefault();
    
    let form = $('#pengajuan-form'); 
    let url = $('#pengajuan-form').attr('action'); 
    $.ajax({
        type: "POST",
        url: url,
        async: false,
        data:form.serializeArray(),
        beforeSend: function (xhr) {
          $('.btn-caption-spinner').show();
          $('.btn-caption-spinner').closest('button').attr('disabled',true);
          $('.btn-caption').hide();
      },
        success: function(response) {
          setTimeout(() => {
            alert(response.message);
            $('.btn-caption-spinner').hide();
            $('.btn-caption-spinner').closest('button').attr('disabled',false);
            $('.btn-caption').show();
            
            const form = document.getElementById('pengajuan-form');
            form.reset();
        }, 2000);
        },
        error: function(a, b, c) {
          $('.btn-caption-spinner').hide();
          $('.btn-caption-spinner').closest('button').attr('disabled',false);
          $('.btn-caption').show();

          const form = document.getElementById('pengajuan-form');
          form.reset();
          // alertFunc("danger", '<i style="color:#c00" class="fa fa-exclamation-triangle" aria-hidden="true"></i> ' + c)
        }
    });
  })