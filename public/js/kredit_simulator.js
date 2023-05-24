
$(document).ready(function(){
    $("#produk_kredit").select2({
      width:"resolve",
      placeholder: "Pilih produk kredit",
      minimumResultsForSearch: -1
    });
    $("#produk_kredit").trigger('change');
    $('.numeric').maskNumber({integer: true});

    $('#kreditsimulator-form').validate({
      rules: {
        produk_kredit: {
          required: true,
        },
        plafond_kredit: {
          required: true,
        },
        jangka_waktu: {
          required: true,
        }
      },
      messages:{
          plafond_kredit: {
            required: '<small class="text-danger">Harap isi plafond kredit</small>'
          },
          jangka_waktu: {
            required: '<small class="text-danger">Harap isi jangka waktu</small>'
          }
      }
  });
})

$("#produk_kredit").change(function(){
  let bunga = $(this).find('option:selected').data('bunga');
  $(".bunga-value").html(bunga+"%");
})

$("#kreditsimulator-form").submit(function(e){
  e.preventDefault();

  let selected = $("#produk_kredit").find('option:selected');
  let produk = selected.data('produk');
  let bunga = selected.data('bunga');
  let plafond_kredit = $('#plafond_kredit').val().replace(/\,/g, '');
  let jangka_waktu = $('#jangka_waktu').val();
  let token = $('input[name="_token"]').val();
  
  let url = $('#kreditsimulator-form').attr('action'); 
  $.ajax({
      type: "POST",
      url: url,
      async: false,
      data:{_token:token,id:produk,bunga:bunga,plafond_kredit:plafond_kredit,jangka_waktu:jangka_waktu},
      beforeSend: function (xhr) {
        $('.btn-caption-spinner').show();
        $('.btn-caption-spinner').closest('button').attr('disabled',true);
        $('.btn-caption').hide();
    },
      success: function(response) {
        setTimeout(() => {
          // alert(response.message);
          $('.btn-caption-spinner').hide();
          $('.btn-caption-spinner').closest('button').attr('disabled',false);
          $('.btn-caption').show();
          
          const form = document.getElementById('kreditsimulator-form');
          form.reset();

          $('input[name="_token"]').val(response.token);

          $("body").append(response.data);
          $("#simulasi-modal").modal('show');
        }, 2000);
      },
      error: function(a, b, c) {
        $('.btn-caption-spinner').hide();
        $('.btn-caption-spinner').closest('button').attr('disabled',false);
        $('.btn-caption').show();

        const form = document.getElementById('kreditsimulator-form');
        form.reset();
        // alertFunc("danger", '<i style="color:#c00" class="fa fa-exclamation-triangle" aria-hidden="true"></i> ' + c)
      }
  });
})

$(document).on('hidden.bs.modal','#simulasi-modal', function () {
  this.remove();
})