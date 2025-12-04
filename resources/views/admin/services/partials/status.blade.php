@if ($data->active)
    <span class="badge badge-pill badge-success"> <i class="la la-check-circle"></i> {{ __('Activé') }}</span>
@else
    <span class="badge badge-pill badge-danger"> <i class="la la-times-circle"></i> {{ __('Désactivé') }}</span>
@endif