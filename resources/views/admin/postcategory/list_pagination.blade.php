
@if(sizeof($category) !== 0)
        @foreach($category as $key => $row)
        <tr>
            <td>{{ $category->firstItem() + $key}}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->slug }}</td>
            <td>{!! $row->status == 'draft' ? '<span class="btn btn-sm btn-inverse-warning btn-fw">Draft</span>' : '<span class="btn btn-sm btn-inverse-info btn-fw">Published</span>'!!}</td>
            <td class="text-right">
                <a title="Edit category" href="{{url('adminpanel/post-category/'.$row->id.'/edit')}}"><i class="mdi mdi-table-edit text-warning"></i></a>
                <a title="Delete category" data-id="{{ $row->id }}" data-name="{{ $row->name }}" href="#" class="delete_btn"><i class=" mdi mdi-close-circle text-danger"></i></a>
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

    @if($category->hasPages())
    <tr>
    <td colspan="5" align="center">
    {!! $category->withQueryString()->links() !!}
    </td>
    </tr>
    @endif