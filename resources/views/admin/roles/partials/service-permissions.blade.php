@foreach ($data->permissions()->whereNotNull('service_id')->pluck('description') as $item)
    <span class="badge badge-warning badge-md badge-glow"> {{ __($item)}} </span>
@endforeach