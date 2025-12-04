@if ($data->is_active)
    <span class="badge badge-success"> <i class="la la-check-circle"></i> {{ __('Active')}} </span>
@else 
    <span class="badge badge-danger"> <i class="la la-times-circle"></i> {{ __('Inactive')}} </span>
@endif