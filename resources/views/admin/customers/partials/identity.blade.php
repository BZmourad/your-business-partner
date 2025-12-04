@if ($data->id_type || $data->id_number)
    <span class="badge badge-primary">
        @switch($data->id_type)
            @case('cin') <strong> {{ __('CIN') }}: </strong> @break
            @case('passport') <strong> {{ __('Passport') }}: </strong> @break
            @case('other') <strong> {{ __($data->id_type_other) }}: </strong> @break
        @endswitch 
        {{ $data->id_number }}
    </span>
@endif
