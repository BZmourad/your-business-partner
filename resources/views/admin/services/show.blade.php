@extends('layout.app')

@section('title', __('Services'))
@section('data_col', "2-columns")
@section('body_class', "2-columns")
@section('active_services', "active")

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

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">{{ __('Services') }}</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">{{ __('Details') }}</li>
                            <li class="breadcrumb-item active">{{ $service->reference }}</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right">
                    <a href="{{ route('admin.services.index') }}" class="btn btn-warning">
                        <i class="la la-list"></i> {{ __('Services')}}
                    </a>
                    <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-blue">
                        <i class="fas fa-edit"></i> {{ __('Edit')}}
                    </a>
                </div>
            </div>
        </div>
        <div class="content-body pb-5">
            <section>
                <div class="row">
                    <div class="col-12">
                        <div class="customer-detail-card card">
                            <div class="customer-detail-header">
                                <span class="text-truncate">
                                    <span>
                                        {{ $service->name }}
                                    </span>
                                </span>
                            </div>
                            <div class="customer-detail-body">
                                @if($service->description)
                                    <div class="detail-group">
                                        <div class="detail-label">{{ __('Description') }}</div>
                                        <div class="detail-value">{{ $service->description }}</div>
                                    </div>
                                @endif
                                <h5 class="section-title mt-2"><i class="fas fa-list-alt mr-1"></i> {{ __('Champs du formulaire') }} <span class="badge badge-pill badge-light ml-2">{{ $service->fields->count() }}</span></h5>
                                <div class="row">
                                    @if($service->fields->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('Nom') }}</th>
                                                        <th>{{ __('Type') }}</th>
                                                        <th>{{ __('Description') }}</th>
                                                        <th class="text-center">{{ __('Obligatoire') }}</th>
                                                        <th>{{ __('Options') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($service->fields as $field)
                                                        <tr>
                                                            <td>
                                                                <strong>{{ $field->name }}</strong>
                                                            </td>
                                                            <td>
                                                                <span class="badge field-type-badge">
                                                                    @switch($field->type)
                                                                        @case('short_text'){{ __('Texte court') }}@break
                                                                        @case('long_text'){{ __('Texte long') }}@break
                                                                        @case('number'){{ __('Nombre') }}@break
                                                                        @case('date'){{ __('Date') }}@break
                                                                        @case('datetime'){{ __('Date et heure') }}@break
                                                                        @case('single_select'){{ __('Sélection simple') }}@break
                                                                        @case('multiple_select'){{ __('Sélection multiple') }}@break
                                                                        @default{{ $field->type }}
                                                                    @endswitch
                                                                </span>
                                                            </td>
                                                            <td>
                                                                @if($field->description)
                                                                    {!! $field->description !!}
                                                                @else
                                                                    <span class="text-muted">{{ __('Aucune description') }}</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                @if($field->is_required)
                                                                    <span class="badge badge-required">{{ __('Oui') }}</span>
                                                                @else
                                                                    <span class="badge badge-optional">{{ __('Non') }}</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($field->options && in_array($field->type, ['single_select', 'multiple_select']))
                                                                    @php
                                                                        $options = explode(',', $field->options);
                                                                    @endphp
                                                                    @if(is_array($options) && count($options) > 0)
                                                                        <div class="options-list">
                                                                            @foreach($options as $option)
                                                                                <span class="badge badge-light mr-1 mb-1">{{ $option }}</span>
                                                                            @endforeach
                                                                        </div>
                                                                    @else
                                                                        <span class="text-muted">{{ __('Aucune option') }}</span>
                                                                    @endif
                                                                @else
                                                                    <span class="text-muted">{{ __('Non applicable') }}</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="text-center py-4">
                                            <i class="fas fa-list-alt fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">{{ __('Aucun champ de formulaire pour ce service') }}</p>
                                        </div>
                                    @endif
                                </div>
                                <h5 class="section-title mt-3"><i class="fas fa-file-alt mr-1"></i> {{ __('Documents requis') }} <span class="badge badge-pill badge-light ml-2">{{ $service->documents->count() }}</span></h5>
                                <div class="row">
                                    @if($service->documents->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('Nom') }}</th>
                                                        <th>{{ __('Description') }}</th>
                                                        <th class="text-center">{{ __('Obligatoire') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($service->documents as $document)
                                                        <tr>
                                                            <td>
                                                                <strong>{{ $document->name }}</strong>
                                                            </td>
                                                            <td>
                                                                @if($document->description)
                                                                    {{ $document->description }}
                                                                @else
                                                                    <span class="text-muted">{{ __('Aucune description') }}</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                @if($document->is_required)
                                                                    <span class="badge badge-required">{{ __('Oui') }}</span>
                                                                @else
                                                                    <span class="badge badge-optional">{{ __('Non') }}</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="text-center py-4">
                                            <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">{{ __('Aucun document requis pour ce service') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
