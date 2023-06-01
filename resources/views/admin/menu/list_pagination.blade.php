
@if(sizeof($menu) !== 0)
        @foreach($menu as $key => $row)
        <tr>
            <td>{{ $menu->firstItem() + $key}}</td>
            <td>{{ $row->name }}</td>
            <td><button type="button" class="btn btn-sm btn-social-icon-text btn-dribbble" style="display: inline-flex;align-items: center;"><i class="mdi mdi-web"></i>{{ url($row->link) }}</button></td>
            <td>{{ $row->order }}</td>
            <td>
                {!! $row->is_active == 1 ? '<span class="btn btn-inverse-info btn-fw mr-2">Active</span>' : '<span class="btn btn-inverse-secondary btn-fw">Inactive</span>'!!}
                
            </td>
            <td class="text-right">
                <a title="Edit menu" href="{{url('adminpanel/menu/'.$row->id.'/edit')}}"><i class="mdi mdi-table-edit text-warning"></i></a>
                <a title="Delete menu" data-id="{{ $row->id }}" data-name="{{ $row->title }}" href="#" class="delete_btn"><i class=" mdi mdi-close-circle text-danger"></i></a>
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

    @if($menu->hasPages())
    <tr>
    <td colspan="8" align="center">
    {!! $menu->withQueryString()->links() !!}
    </td>
    </tr>
    @endif