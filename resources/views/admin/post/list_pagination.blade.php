
@if(sizeof($posts) !== 0)
        @foreach($posts as $key => $row)
        <tr>
            <td>{{ $posts->firstItem() + $key}}</td>
            <td>{{ $row->title }}</td>
            <td>{{ $row->createdby->name }}</td>
            <td>{{ $row->category->name }}</td>
            <td>{{ $row->views }}</td>
            <td>{{ \Carbon\Carbon::parse($row->date_publish)->diffForHumans() }}</td>
            <td>{!! $row->status == 'draft' ? '<span class="btn btn-sm btn-inverse-warning btn-fw">Draft</span>' : '<span class="btn btn-sm btn-inverse-info btn-fw">Published</span>'!!}</td>
            <td class="text-right">
                <a title="Edit post" href="{{url('adminpanel/post/'.$row->id.'/edit')}}"><i class="mdi mdi-table-edit text-warning"></i></a>
                <a title="Delete post" data-id="{{ $row->id }}" data-name="{{ $row->title }}" href="#" class="delete_btn"><i class=" mdi mdi-close-circle text-danger"></i></a>
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

    @if($posts->hasPages())
    <tr>
    <td colspan="8" align="center">
    {!! $posts->withQueryString()->links() !!}
    </td>
    </tr>
    @endif