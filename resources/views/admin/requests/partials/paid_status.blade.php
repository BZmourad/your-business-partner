@switch($data->paid_status)
    @case('paid')
        <span class="badge badge-pill badge-success"> <i class="la la-check-circle"></i> {{ __('Paid') }}</span>
    @break
    @case('unpaid')
        <span class="badge badge-pill badge-danger"> <i class="la la-times-circle"></i> {{ __('Unpaid') }}</span>
    @break
@endswitch 
