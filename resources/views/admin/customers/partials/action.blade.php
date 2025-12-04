<span class="dropdown actions-datatable float-md-right">
    <button id="btnSearchDrop{{$data->id}}" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-secondary btn-sm dropdown-toggle dropdown-menu-right">
        <i class="la la-ellipsis-v"></i>
    </button>
    <span aria-labelledby="btnSearchDrop{{$data->id}}" class="dropdown-menu mt-1 dropdown-menu-right">
        <button class="dropdown-item" type="button" data-toggle="modal" data-target="#emailModal" data-id="{{$data->id}}" data-email="{{$data->email}}"><i class="la la-send"></i> {{ __('Send email')}}</button>
        <a class="dropdown-item" href="{{route('admin.customers.show',$data->id)}}"><i class="la la-eye"></i> {{ __('Consulter')}}</a>
        <a class="dropdown-item" href="{{route('admin.customers.edit',$data->id)}}"><i class="la la-edit"></i> {{ __('Modifier')}}</a>
        @if ($data->user)
            @if ($data->user->is_active)
                <button class="dropdown-item activateData" type="button" data-id="{{$data->id}}"><i class="la la-times"></i> {{ __('Désactiver account')}}</button>
            @else
                <button class="dropdown-item activateData" type="button" data-id="{{$data->id}}"><i class="la la-check"></i> {{ __('Activer account')}}</button>
            @endif
            <button class="dropdown-item deleteAccountData" type="button" data-id="{{$data->user->id}}"><i class="la la-user-times"></i> {{ __('Delete account')}}</button>
        @else
            <button class="dropdown-item" data-toggle="modal" data-target="#addAccountModal" type="button" data-id="{{$data->id}}"><i class="la la-user-plus"></i> {{ __('Add account')}}</button>
        @endif
        @if ($data->demandes_count == 0)
            <button class="dropdown-item deleteData" type="button" data-id="{{$data->id}}"> <i class="la la-trash"></i> {{ __('Supprimer')}} </button>
        @endif
    </span>
</span>