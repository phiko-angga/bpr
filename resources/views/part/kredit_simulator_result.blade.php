

  <div class="modal" id="simulasi-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirm_title"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
          <h4>Produk kredit {{$produk->nama}}, dengan bunga : {{$produk->bunga}}%</h4>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th width="5">Angsuran Ke</th>
                <th class="text-end">Pokok</th>
                <th class="text-end">Bunga</th>
                <th class="text-end">Total</th>
                <th class="text-end">O/S Pokok</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-end">{{number_format($plafond_kredit,2)}}</td>
              </tr>
            @php
              $sisakredit = $plafond_kredit;
            @endphp
            @for($i = 1; $i <= $jangka_waktu; $i++)
              @php
                $rpokok = 0;
                $rbunga = $sisakredit * $bungaPerBulan / 100;
                $sisakredit -= $pokok;
              @endphp
              <tr>
                <td>{{$i}}</td>
                <td class="text-end">{{number_format($pokok,2)}}</td>
                <td class="text-end">{{number_format($rbunga,2)}}</td>
                <td class="text-end">{{number_format($pokok + $rbunga,2)}}</td>
                <td class="text-end">{{number_format($sisakredit,2)}}</td>
              </tr>
            @endfor
            </tbody>
          </table>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  

  
