@switch($data->status)
    @case('pending')
        <span class="badge badge-pill badge-warning">{{ __('En attente') }}</span>
    @break
    @case('in_progress')
        <span class="badge badge-pill badge-info">{{ __('En cours') }}</span>
    @break
    @case('completed')
        <span class="badge badge-pill badge-success">{{ __('Terminée') }}</span>
    @break
    @case('refused')
        <span class="badge badge-pill badge-danger">{{ __('refusé') }}</span>
    @break
@endswitch

