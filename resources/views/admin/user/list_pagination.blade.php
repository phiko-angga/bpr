
@if(sizeof($user) !== 0)
        @foreach($user as $key => $row)
        <tr>
            <td>{{ $user->firstItem() + $key}}</td>
            <td>{{ $row->name }}</td>
            <td class="text-right">
                <a title="Edit User" href="{{url('adminpanel/users/'.$row->id.'/edit')}}"><i class="mdi mdi-table-edit text-warning"></i></a>
                <a title="Delete User" data-id="{{ $row->id }}" data-name="{{ $row->name }}" href="#" class="delete_btn"><i class=" mdi mdi-close-circle text-danger"></i></a>
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

    @if($user->hasPages())
    <tr>
    <td colspan="5" align="center">
    {!! $user->withQueryString()->links() !!}
    </td>
    </tr>
    @endif