
@if(sizeof($pages) !== 0)
        @foreach($pages as $key => $row)
        <tr>
            <td>{{ $pages->firstItem() + $key}}</td>
            <td>{{ $row->title }}</td>
            <td>{{ $row->views }}</td>
            <td>{!! $row->status == 'draft' ? '<span class="btn btn-sm btn-inverse-warning btn-fw">Draft</span>' : '<span class="btn btn-sm btn-inverse-info btn-fw">Published</span>'!!}</td>
            <td class="text-right">
                <a title="Edit page" href="{{url('adminpanel/pages/'.$row->id.'/edit')}}"><i class="mdi mdi-table-edit text-warning"></i></a>
                <a title="Delete page" data-id="{{ $row->id }}" data-name="{{ $row->title }}" href="#" class="delete_btn"><i class=" mdi mdi-close-circle text-danger"></i></a>
            </td>
        </tr>
        @endforeach
    @else
    <tr>
        <td colspan="8" align="center">
            <h4 class="text-center">No Data Available</h4>
        </td>
    </tr>
    @endif

    @if($pages->hasPages())
    <tr>
    <td colspan="8" align="center">
    {!! $pages->withQueryString()->links() !!}
    </td>
    </tr>
    @endif