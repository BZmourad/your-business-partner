<div class="btn-group float-md-right">
    <a href="{{ route('admin.requests.index') }}" class="btn btn-warning">
        <i class="la la-list"></i> {{ __('Requests') }}
    </a>
    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="sr-only">{{ __("Update Status")}}</span>
    </button>
    <div class="dropdown-menu">
        @if (($request->status == "in_progress") && ($request->paid_status == "paid"))
            <button class="dropdown-item statusData" data-toggle="modal" data-target="#setStatusModal" type="button" data-id="{{$request->id}}" data-status="completed"><i class="fa fa-check"></i> {{ __('Terminer')}}</button>
        @endif
        @if ($request->status == "pending")
            <button class="dropdown-item statusData" data-toggle="modal" data-target="#setStatusModal" type="button" data-id="{{$request->id}}" data-status="in_progress"><i class="fa fa-play"></i> {{ __('Démarrer')}}</button>
        @endif
        @if ($request->status != "pending")
            <button class="dropdown-item statusData" data-toggle="modal" data-target="#setStatusModal" type="button" data-id="{{$request->id}}" data-status="pending"><i class="la la-pause"></i> {{ __('Suspendre')}}</button>
        @endif
        @if (($request->paid_status != "paid") && ($request->status != "refused"))
            <button class="dropdown-item statusData" data-toggle="modal" data-target="#setStatusModal" type="button" data-id="{{$request->id}}" data-status="refused"><i class="fa fa-times"></i> {{ __('Refuser')}}</button>
        @endif
        <div class="dropdown-divider"></div>
        @if ($request->paid_status == "paid")
            <button class="dropdown-item statusPaidData" data-toggle="modal" data-target="#setPaidStatusModal" type="button" data-id="{{$request->id}}" data-status="unpaid"><i class="la la-times-circle"></i> {{ __('Marquer comme impayé')}}</button>
        @else
            <button class="dropdown-item statusPaidData" data-toggle="modal" data-target="#setPaidStatusModal" type="button" data-id="{{$request->id}}" data-status="paid"><i class="la la-check-square"></i> {{ __('Marquer comme payé')}}</button>
        @endif
    </div>
</div>