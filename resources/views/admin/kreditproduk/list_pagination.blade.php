
@if(sizeof($kreditProduk) !== 0)
        @foreach($kreditProduk as $key => $row)
        <tr>
            <td>{{ $kreditProduk->firstItem() + $key}}</td>
            <td>{{ $row->nama }}</td>
            <td>{{ $row->bunga }}</td>
            <td class="text-right">
                <a title="Edit produk kredit" href="{{url('adminpanel/produk-kredit/'.$row->id.'/edit')}}"><i class="mdi mdi-table-edit text-warning"></i></a>
                <a title="Delete produk kredit" data-id="{{ $row->id }}" data-name="{{ $row->name }}" href="#" class="delete_btn"><i class=" mdi mdi-close-circle text-danger"></i></a>
            </td>
        </tr>
        @endforeach
    @else
    <tr>
        <td colspan="5" align="center">
            <h4 class="text-center">No Data Available</h4>
        </td>
    </tr>
    @endif

    @if($kreditProduk->hasPages())
    <tr>
    <td colspan="5" align="center">
    {!! $kreditProduk->withQueryString()->links() !!}
    </td>
    </tr>
    @endif