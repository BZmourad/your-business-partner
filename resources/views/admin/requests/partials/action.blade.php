<span class="dropdown actions-datatable float-md-right">
    <button id="btnSearchDrop{{$data->id}}" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-secondary btn-sm dropdown-toggle dropdown-menu-right">
        <i class="la la-ellipsis-v"></i>
    </button>
    <span aria-labelledby="btnSearchDrop{{$data->id}}" class="dropdown-menu mt-1 dropdown-menu-right">
        <a class="dropdown-item" href="{{route('admin.requests.show',$data->id)}}"><i class="la la-eye"></i> {{ __('Consulter')}}</a>
        <button class="dropdown-item deleteData" type="button" data-id="{{$data->id}}"><i class="la la-trash"></i> {{ __('Supprimer')}}</button>
        <div class="dropdown-divider"></div>
        @if (($data->status == "in_progress") && ($data->paid_status == "paid"))
            <button class="dropdown-item statusData" type="button" data-toggle="modal" data-target="#setStatusModal" data-id="{{$data->id}}" data-status="completed"><i class="fa fa-check"></i> {{ __('Terminer')}}</button>
        @endif
        @if ($data->status == "pending")
            <button class="dropdown-item statusData" type="button" data-toggle="modal" data-target="#setStatusModal" data-id="{{$data->id}}" data-status="in_progress"><i class="fa fa-play"></i> {{ __('Démarrer')}}</button>
        @endif
        @if ($data->status != "pending")
            <button class="dropdown-item statusData" type="button" data-toggle="modal" data-target="#setStatusModal" data-id="{{$data->id}}" data-status="pending"><i class="la la-pause"></i> {{ __('Suspendre')}}</button>
        @endif
        @if (($data->paid_status != "paid") && ($data->status != "refused"))
            <button class="dropdown-item statusData" type="button" data-toggle="modal" data-target="#setStatusModal" data-id="{{$data->id}}" data-status="refused"><i class="fa fa-times"></i> {{ __('Refuser')}}</button>
        @endif
        <div class="dropdown-divider"></div>
        @if ($data->paid_status == "paid")
            <button class="dropdown-item statusPaidData" type="button" data-toggle="modal" data-target="#setPaidStatusModal" data-id="{{$data->id}}" data-status="unpaid"><i class="la la-times-circle"></i> {{ __('Marquer comme impayé')}}</button>
        @else
            <button class="dropdown-item statusPaidData" type="button" data-toggle="modal" data-target="#setPaidStatusModal" data-id="{{$data->id}}" data-status="paid"><i class="la la-check-square"></i> {{ __('Marquer comme payé')}}</button>
        @endif
    </span>
</span>