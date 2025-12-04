<div class="row">
    <div class="col-12">
        <div class="customer-detail-card card">
            <div class="customer-detail-header">
                <span class="text-truncate">
                    <span>
                        @php
                            $icon = "";
                            $text = "";
                            switch ($request->status) {
                                case 'pending': $icon = '<i class="la la-pause"></i>'; $text = __("Demande en attente"); $color = "badge-warning"; break;
                                case 'in_progress': $icon = '<i class="la la-play"></i>'; $text = __("Traitement démarré"); $color = "badge-info"; break;
                                case 'completed': $icon = '<i class="fa fa-check"></i>'; $text = __("Demande terminée"); $color = "badge-success"; break;
                                case 'refused': $icon = '<i class="fa fa-times"></i>'; $text = __("Demande rejetée"); $color = "badge-danger"; break;
                                default: break;
                            }
                        @endphp
                        <span class="badge badge-lg {{$color}}"> {!! $icon !!} {!! $text !!} </span>
                    </span>
                </span>
                @switch($request->paid_status)
                    @case('paid')
                        <span class="badge badge-lg badge-success"><i class="la la-check-circle"></i> {{ __('Paid') }}</span>
                    @break
                    @case('unpaid')
                        <span class="badge badge-lg badge-danger"><i class="la la-times-circle"></i> {{ __('Unpaid') }}</span>
                    @break
                @endswitch 
            </div>
            <div class="customer-detail-body">
                <h5 class="section-title"><i class="fas fa-info-circle mr-1"></i> {{ __('Informations du service') }}</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('Service') }}</div>
                            <div class="detail-value">{{ $request->service->reference }}| {{ $request->service->name }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('Customer') }}</div>
                            <div class="detail-value">{{ $request->customer->reference }}| {{ $request->customer->first_name }} {{ $request->customer->last_name }}</div>
                        </div>
                    </div>
                </div>
                @if($request->fields->count() > 0)
                    <h5 class="section-title mt-4">
                        <i class="fas fa-list-alt mr-1"></i> {{ __('Réponses du Formulaire') }} 
                        <button type="button" data-toggle="modal" data-target="#updateFormsModal" class="btn btn-sm btn-blue ml-2"> <i class="la la-edit"></i> </button>
                    </h5>
                    <div class="row">
                        @if ($request->fields)
                            <table class="table table-bordered">
                                <tbody>
                                    @if ($request->note)
                                        <tr>
                                            <td class="blue-dark bg-blue bg-lighten-5 w-25">{{ __("Note") }}</td>
                                            <td>
                                                {{ $request->note }}
                                            </td>
                                        </tr>
                                    @endif
                                    @foreach($request->fields as $response)
                                        <tr>
                                            <td class="blue-dark bg-blue bg-lighten-5 w-25">{{ $response->name }}</td>
                                            <td>
                                                <span class="response-value">
                                                    @if($response->isSelectType())
                                                        @if(is_array($response->response))
                                                            {{ implode(', ', $response->response) }}
                                                        @else
                                                            {{ $response->response }}
                                                        @endif
                                                    @else
                                                        {{ $response->response ?? __('Non renseigné') }}
                                                    @endif
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('styles')
    <style>
        .customer-detail-card {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .customer-detail-header {
            background-color: #f8f9fa;
            padding: 15px 20px;
            border-bottom: 1px solid #e9ecef;
            font-weight: 600;
            font-size: 1.1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .customer-detail-body {
            padding: 20px;
        }
        .detail-group {
            margin-bottom: 15px;
            padding: 5px;
            border: 1px grey dashed;
        }
        .detail-label {
            font-weight: 600;
            color: black;
            font-size: 0.85rem;
            margin-bottom: 5px;
        }
        .detail-value {
            font-size: 1rem;
            color: #495057;
        }
        .section-title {
            border-bottom: 2px solid #002960;
            padding-bottom: 8px;
            margin-bottom: 20px;
            color: #002960;
            font-weight: 600;
        }
        .badge-particulier {
            background-color: #002960;
            color: white;
        }
        .badge-entreprise {
            background-color: #28a745;
            color: white;
        }
    </style>
@endpush