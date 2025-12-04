@if ($data->email)
    <i class="la la-envelope"></i> {{$data->email}}
@endif
@if ($data->phone)
    <br><i class="la la-phone"></i> {{$data->phone}}
@endif
@if ($data->address)
    <br><i class="la la-map-marker"></i> {{$data->address}}
@endif