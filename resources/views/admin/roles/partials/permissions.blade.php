@foreach ($data->permissions()->whereNull('service_id')->get() as $item)
    <span class="badge badge-primary badge-md badge-glow"> <i class="{{$item->icon}}"></i> {{ __($item->description)}} </span>
@endforeach