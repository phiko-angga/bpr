<div class="kredit_simulator" style="width: 100%;
    height: 550px;
    padding: 30px;
    background: white;
    border: 2px solid #03A9F4;
    border-radius: 10px;">
  <h4 class="text-center">SIMULATOR KREDIT</h4>
  <hr class="m-0">
  <p class="text-center" style="margin-bottom:0">Bunga per Tahun Mulai</p>
  <h2 class="bunga-value" style="    text-align: center;
    font-size: 60px;
    color: var(--color-primary);margin-bottom:40px">8.75%</h2>

  <div class="form-group" style="margin-bottom:20px;width:100%">
    <label style="color:var(--color-primary);font-weight:600" class="sr-only" for="">Produk Kredit</label>
    <select class="form-control" name="produk_kredit" id="produk_kredit">
      @if($produk)
        @foreach($produk as $p)
        <option class="text-center" data-bunga="{{$p->bunga}}" value="{{$p->id}}">{{$p->nama}}</option>
        @endforeach
      @endif
    </select>
  </div>
  <div class="form-group" style="margin-bottom:20px">
    <label style="color:var(--color-primary);font-weight:600" for="">Plafond Kredit</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text" style="border-top-right-radius:0;border-bottom-right-radius:0;">Rp</span>
      </div>
      <input type="number" class="form-control" placeholder="Nominal" aria-label="Nominal">
    </div>
  </div>
  <div class="form-group" style="margin-bottom:20px">
    <label style="color:var(--color-primary);font-weight:600" for="">Jangka Waktu (Bulan)</label>
      <input type="number" class="form-control" placeholder="Max. 240" aria-label="Max. 240">
  </div>
  <div class="form-group" style="margin-bottom:20px">
    <button type="button" id="btn_kalkulasi" class="btn btn-primary" style="width:100%;background-color:var(--color-primary)">KALKULASI</button>
  </div>
</div>
