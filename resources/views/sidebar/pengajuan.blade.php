<div class="pengajuan" style="width: 100%;
    height: 550px;
    padding: 30px;
    background: var(--color-primary);
    border-radius: 10px;
    margin-bottom:24px;
    color:white">
  <h4 class="text-center">PENGAJUAN KREDIT</h4>

  <form method="post" id="pengajuan-form" action="{{url('kirim-pengajuan')}}">
    @csrf
    <div class="form-group" style="margin-top:40px;">
      <div class="input-group" style="margin-bottom:20px">
        <div class="input-group-prepend">
          <span class="input-group-text" style="border-top-right-radius:0;border-bottom-right-radius:0;"><i class="bi bi-person"></i></span>
        </div>
        <input require type="text" class="form-control" name="nama" placeholder="Nama" aria-label="Nama">
      </div>
      <div class="input-group" style="margin-bottom:20px">
        <div class="input-group-prepend">
          <span class="input-group-text" style="border-top-right-radius:0;border-bottom-right-radius:0;"><i class="bi bi-house"></i></span>
        </div>
        <input require type="text" class="form-control" name="alamat" placeholder="Alamat" aria-label="Alamat">
      </div>
      <div class="input-group" style="margin-bottom:20px">
        <div class="input-group-prepend">
          <span class="input-group-text" style="border-top-right-radius:0;border-bottom-right-radius:0;"><i class="bi bi-telephone"></i></span>
        </div>
        <input require type="number" class="form-control" name="telp" placeholder="Telp" aria-label="Telp">
      </div>
      <div class="input-group" style="margin-bottom:20px">
        <div class="input-group-prepend">
          <span class="input-group-text" style="border-top-right-radius:0;border-bottom-right-radius:0;"><i class="bi bi-envelope"></i></span>
        </div>
        <input type="email" class="form-control" name="email" placeholder="Email" aria-label="Email">
      </div>
      <div class="input-group" style="margin-bottom:20px">
        <textarea class="form-control" name="pesan" id="pesan" cols="30" rows="4" placeholder="pesan"></textarea>
      </div>
    </div>
    <div class="form-group" style="margin-bottom:20px">
      <button type="button" id="btn_kirim" class="btn btn-primary" style="width:100%;background-color:var(--color-secondary)">
        <div class="btn-caption" role="status">KIRIM</div>
        <div style="display:none" class="spinner-border btn-caption-spinner" role="status"></div>
      </button>
    </div>
  </form>
</div>
