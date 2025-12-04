@if($data->partner_type == 'particulier')
    <span class="badge badge-warning">{{ __('Particulier') }}</span>
@else
    <span class="badge badge-success">{{ __('Entreprise') }}</span>
@endif