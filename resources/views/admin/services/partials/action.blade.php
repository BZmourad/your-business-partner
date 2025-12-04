<span class="dropdown actions-datatable float-md-right">
    <button id="btnSearchDrop{{$data->id}}" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-secondary btn-sm dropdown-toggle dropdown-menu-right">
        <i class="la la-ellipsis-v"></i>
    </button>
    <span aria-labelledby="btnSearchDrop{{$data->id}}" class="dropdown-menu mt-1 dropdown-menu-right">
        @can($data->slug && $data->active)
            <a class="dropdown-item" href="{{route('admin.requests.add',$data->id)}}"><i class="la la-plus"></i> {{ __('Create Request')}}</a>
        @endcan
        <a class="dropdown-item" href="{{route('admin.services.show',$data->id)}}"><i class="la la-eye"></i> {{ __('Consulter')}}</a>
        <a class="dropdown-item" href="{{route('admin.services.edit',$data->id)}}"><i class="la la-edit"></i> {{ __('Modifier')}}</a>
        @if ($data->active)
            <button class="dropdown-item activateData" type="button" data-id="{{$data->id}}"><i class="la la-times"></i> {{ __('Désactiver')}}</button>
        @else
            <button class="dropdown-item activateData" type="button" data-id="{{$data->id}}"><i class="la la-check"></i> {{ __('Activer')}}</button>
        @endif
        @if ($data->demandes_count == 0)
            <button class="dropdown-item deleteData" type="button" data-id="{{$data->id}}"><i class="la la-trash"></i> {{ __('Supprimer')}}</button>
        @endif
    </span>
</span>