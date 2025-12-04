<span class="dropdown actions-datatable float-md-right">
    <button id="btnSearchDrop{{$data->id}}" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-secondary btn-sm dropdown-toggle dropdown-menu-right">
        <i class="la la-ellipsis-v"></i>
    </button>
    <span aria-labelledby="btnSearchDrop{{$data->id}}" class="dropdown-menu mt-1 dropdown-menu-right">
        <a class="dropdown-item" href="{{route('customer.documents.show',$data->id)}}"><i class="la la-eye"></i> {{ __('Consulter')}}</a>
        @if (auth()->id() == $data->created_by)
            <button class="dropdown-item editData" type="button" data-id="{{$data->id}}"><i class="la la-edit"></i> {{ __('Modifier')}}</button>
        @endif
        @if ($data->permissions()->where('user_id', auth()->id())->where('has_delete', true)->exists())
            <button class="dropdown-item deleteData" type="button" data-id="{{$data->id}}"> <i class="la la-trash"></i> {{ __('Delete')}} </button>
        @endif
        @if ($data->permissions()->where('user_id', auth()->id())->where('has_download', true)->exists())
            <a class="dropdown-item" href="{{route('customer.documents.download',$data->id)}}" target="_blanc"><i class="la la-download"></i> {{ __('Download')}}</a>
        @endif
    </span>
</span>