@if ($data->user)
    <span class="badge badge-success">{{ __('Yes')}}</span>
    @if (!$data->user->is_active)
        <span class="badge badge-danger">{{ __('Désactivé')}}</span>
    @endif
@else
    <span class="badge badge-danger">{{ __('No')}}</span>
@endif