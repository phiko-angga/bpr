
@if(sizeof($pengajuan) !== 0)
        @foreach($pengajuan as $key => $row)
        <tr>
            <td>{{ $pengajuan->firstItem() + $key}}</td>
            <td>{{ \Carbon\Carbon::parse($row->created_at)->diffForHumans() }}</td>
            <td>{{ $row->nama }}</td>
            <td>{{ $row->alamat }}</td>
            <td>{{ $row->telp }}</td>
            <td>{{ $row->email }}</td>
            <td>{{ $row->pesan }}</td>
        </tr>
        @endforeach
    @else
    <tr>
        <td colspan="8" align="center">
            <h4 class="text-center">No Data Available</h4>
        </td>
    </tr>
    @endif

    @if($pengajuan->hasPages())
    <tr>
    <td colspan="8" align="center">
    {!! $pengajuan->withQueryString()->links() !!}
    </td>
    </tr>
    @endif