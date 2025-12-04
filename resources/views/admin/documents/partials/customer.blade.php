@if ($data->request)
    <a class="btn btn-light btn-sm text-dark" target="_blanc" href="{{route('admin.customers.show', $data->request->customer_id)}}">
        {{$data->request->customer->reference.'| '.$data->request->customer->last_name.' '.$data->request->customer->first_name}}
    </a>
@endif