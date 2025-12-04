<span class="dropdown actions-datatable float-md-right">
    <button id="btnSearchDrop{{$data->id}}" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-secondary btn-sm dropdown-toggle dropdown-menu-right">
        <i class="la la-ellipsis-v"></i>
    </button>
    <span aria-labelledby="btnSearchDrop{{$data->id}}" class="dropdown-menu mt-1 dropdown-menu-right">
        <a class="dropdown-item" href="{{route('admin.documents.show',$data->id)}}"><i class="la la-eye"></i> {{ __('Consulter')}}</a>
        <button class="dropdown-item editData" type="button" data-id="{{$data->id}}"><i class="la la-edit"></i> {{ __('Modifier')}}</button>
        <button class="dropdown-item deleteData" type="button" data-id="{{$data->id}}"> <i class="la la-trash"></i> {{ __('Delete')}} </button>
        <a class="dropdown-item" href="{{route('admin.documents.download',$data->id)}}" target="_blanc"><i class="la la-download"></i> {{ __('Download')}}</a>
        <button class="dropdown-item" type="button" data-toggle="modal" data-target="#docMonthModal" data-id="{{$data->id}}" data-month="{{$data->month}}" data-year="{{$data->year}}"><i class="la la-calendar"></i> {{ __('Affecter à un mois')}}</button>
    </span>
</span>