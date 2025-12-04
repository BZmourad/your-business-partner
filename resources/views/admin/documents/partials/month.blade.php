@if ($data->year || $data->month)
    @php
        $months = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
    @endphp
    <span class="badge badge-sm badge-success"> <i class="la la-calendar"></i> {{ $data->month ? $months[$data->month-1] : ''}} {{$data->year}} </span>
@endif