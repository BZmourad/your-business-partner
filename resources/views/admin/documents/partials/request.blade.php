@if ($data->request)
    <a class="btn btn-light btn-sm text-dark" target="_blanc" href="{{route('admin.requests.show', $data->request->id)}}"> {{$data->request->reference}} </a>
@endif