@if ($data->data_id)
    @php
        $c = null;
        $r = "";
        switch ($data->module) {
            case 'customer': $c = \App\Models\Customer\Customer::find($data->data_id); $r = route('admin.customers.show', $data->data_id); break;
            case 'partner': $c = \App\Models\Partner\Partner::find($data->data_id); $r = route('admin.partners.show', $data->data_id); break;
            case 'service': $c = \App\Models\Service\Service::find($data->data_id); $r = route('admin.services.show', $data->data_id); break;
            case 'request': $c = \App\Models\Request\Request::find($data->data_id); $r = route('admin.requests.show', $data->data_id); break;
            case 'document': $c = \App\Models\Document\Document::find($data->data_id); $r = route('admin.documents.show', $data->data_id); break;
            case 'role': $c = \App\Models\Permission\Role::find($data->data_id); $r = route('admin.roles.index'); break;
            case 'user': $c = \App\Models\User::find($data->data_id); $r = route('admin.users.show', $data->data_id); break;
        }
    @endphp
    @if ($c)
        <a class="btn btn-light btn-sm text-dark" target="_blanc" href="{{$r ? $r : ''}}"> {{$c->reference??$c->name}} </a>
    @else
        <span class="badge bg-danger bg-accent-2 text-dark"> {{$data->reference}} </span>
    @endif
@elseif ($data->reference)
    <span class="badge bg-danger bg-accent-2 text-dark"> {{$data->reference}} </span>
@endif