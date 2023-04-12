
@if(sizeof($banner) !== 0)
        @foreach($banner as $key => $row)
        <tr>
            <td>{{ $banner->firstItem() + $key}}</td>
            <td>
                <a target="_blank" href="{{url('img/banner/'.$row->image)}}" class="glightbox">
                    <img class="img-fluid" style="width:120px;height:auto;border-radius:0;" src="{{url('img/banner/'.$row->image)}}" alt="">
                </a>
            </td>
            <td>{{ $row->description }}</td>
            <td>{!! $row->status == 'draft' ? '<span class="btn btn-sm btn-inverse-warning btn-fw">Draft</span>' : '<span class="btn btn-sm btn-inverse-info btn-fw">Published</span>'!!}</td>
            <td>{{ $row->order }}</td>
            <td class="text-right">
                <a title="Edit banner" href="{{url('adminpanel/home-banner/'.$row->id.'/edit')}}"><i class="mdi mdi-table-edit text-warning"></i></a>
                <a title="Delete bannr" data-id="{{ $row->id }}" data-name="{{ $row->description }}" href="#" class="delete_btn"><i class=" mdi mdi-close-circle text-danger"></i></a>
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

    @if($banner->hasPages())
    <tr>
    <td colspan="8" align="center">
    {!! $banner->withQueryString()->links() !!}
    </td>
    </tr>
    @endif