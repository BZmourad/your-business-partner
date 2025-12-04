<span class="dropdown actions-datatable float-md-right">
    <button id="btnSearchDrop{{$data->id}}" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-secondary btn-sm dropdown-toggle dropdown-menu-right">
        <i class="la la-ellipsis-v"></i>
    </button>
    <span aria-labelledby="btnSearchDrop{{$data->id}}" class="dropdown-menu mt-1 dropdown-menu-right">
        <a class="dropdown-item" href="{{ $data->id == auth()->id() ? route('admin.profile') : route('admin.users.show',$data->id)}}"><i class="la la-eye"></i> {{ __('Consulter')}}</a>
        @if ($data->id != auth()->id() && $data->id != 1)
            <a class="dropdown-item" href="{{route('admin.users.edit',$data->id)}}"><i class="la la-edit"></i> {{ __('Modifier')}}</a>
            @if ($data->is_active)
                <button class="dropdown-item activateData" type="button" data-id="{{$data->id}}"><i class="la la-times"></i> {{ __('Désactiver')}}</button>
            @else
                <button class="dropdown-item activateData" type="button" data-id="{{$data->id}}"><i class="la la-check"></i> {{ __('Activer')}}</button>
            @endif
            <button class="dropdown-item deleteData" type="button" data-id="{{$data->id}}"><i class="la la-trash"></i> {{ __('Supprimer')}}</button>
        @endif
    </span>
</span>