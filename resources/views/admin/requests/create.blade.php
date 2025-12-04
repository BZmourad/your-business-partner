@extends('layout.app')

@section('title', __('Requests'))
@section('data_col', "2-columns")
@section('body_class', "2-columns")
@section('active_new_requests', "active")

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ $service->reference }}| {{$service->name}}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"> {{ __('Requests') }}</li>
                                <li class="breadcrumb-item active"> {{ __('Add') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                        <a href="{{ route('admin.requests.choose.services') }}" class="btn btn-secondary">
                            <i class="la la-angle-left"></i> {{ __('Choose service') }}
                        </a>
                        <a href="{{ route('admin.requests.index') }}" class="btn btn-warning"> <i class="la la-list"></i> {{ __('Requests') }} </a>
                        <button type="submit" form="requestForm" class="btn btn-success">
                            <i class="fas fa-check"></i> {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </div>
            <div class="content-body pb-5">
                <section class="mb-4">
                    <form id="requestForm" method="POST" action="{{ route('admin.requests.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="service_id" value="{{$service->id}}">
                        <div class="row match-height">
                            <div class="col-md-5">
                                <div class="card h-100">
                                    <div class="card-content">
                                        <div class="card-header bg-light">
                                            <h4 class="card-title"> {{ __("Formulaire de la demande")}} </h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 mt-1">
                                                    <label for="notes">{{ __('Customer') }} <span class="text-danger">*</span></label>
                                                    <select class="form-control select2" id="customer_id" name="customer_id" required>
                                                        <option value="">{{ __('Sélectionner un client') }}</option>
                                                        @foreach($customers as $customer)
                                                            <option value="{{ $customer->id }}"> {{$customer->reference}}| {{ $customer->last_name .' '. $customer->first_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-12 mt-1">
                                                    <label for="notes">{{ __('Note') }}</label>
                                                    <textarea name="notes" id="notes" class="form-control" rows="4"></textarea>
                                                </div>
                                                @foreach ($service->fields as $field)
                                                    <div class="col-md-12 mt-1">
                                                        <label for="field_{{ $field->id }}">{{ $field->name }} @if($field->is_required)<span class="text-danger">*</span>@endif</label>
                                                        @if ($field->type == "short_text")
                                                            <input type="text" name="fields[{{ $field->id }}]" id="field_{{ $field->id }}" class="form-control" @if($field->is_required) required @endif>
                                                        @elseif ($field->type == "long_text")
                                                            <textarea name="fields[{{ $field->id }}]" id="field_{{ $field->id }}" class="form-control" @if($field->is_required) required @endif rows="4"></textarea>
                                                        @elseif ($field->type == "number")
                                                            <input type="number" name="fields[{{ $field->id }}]" id="field_{{ $field->id }}" class="form-control" @if($field->is_required) required @endif>
                                                        @elseif ($field->type == "date")
                                                            <input type="date" name="fields[{{ $field->id }}]" id="field_{{ $field->id }}" class="form-control" @if($field->is_required) required @endif>
                                                        @elseif ($field->type == "datetime")
                                                            <input type="datetime-local" name="fields[{{ $field->id }}]" id="field_{{ $field->id }}" class="form-control" @if($field->is_required) required @endif>
                                                        @elseif ($field->type == "single_select")
                                                            @php
                                                                $options = explode(',', $field->options);
                                                            @endphp
                                                            @if ($options)
                                                                <select name="fields[{{ $field->id }}]" id="field_{{ $field->id }}" class="form-control" @if($field->is_required) required @endif>
                                                                    <option value="">{{ __('Sélectionner une option') }}</option>
                                                                    @foreach ($options as $item)
                                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                                    @endforeach
                                                                </select>
                                                            @endif
                                                        @elseif ($field->type == "multiple_select")
                                                            @php
                                                                $options = explode(',', $field->options);
                                                            @endphp
                                                            @if ($options)
                                                                <select name="fields[{{ $field->id }}][]" id="field_{{ $field->id }}" class="form-control" @if($field->is_required) required @endif multiple>
                                                                    @foreach ($options as $item)
                                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                                    @endforeach
                                                                </select>
                                                            @endif
                                                        @endif
                                                        @if ($field->description) <small class="form-text text-muted"> {!! $field->description !!} </small> @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="card h-100">
                                    <div class="card-content">
                                        <div class="card-header bg-light">
                                            <h4 class="card-title"> {{ __("Documents demandés")}} </h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach ($service->documents as $document)
                                                    <div class="col-md-12 mb-2">
                                                        <div class="file-input-wrapper">
                                                            <div class="file-input-custom file-input-multiple" id="custom_{{ $document->id }}">
                                                                <div class="file-input-text">
                                                                    <div class="file-category-name">{{ $document->name }} @if($document->is_required)<span class="text-danger">*</span> @endif</div>
                                                                    <div class="select-number-files"></div>
                                                                </div>
                                                                <div class="file-input-hint">
                                                                    @if ($document->description) {!! $document->description !!} <br> @endif
                                                                    {{ __('Formats acceptés: PDF, DOC, DOCX, JPG, PNG') }}<br>
                                                                    {{ __('Taille max: 5MB') }} {{ __('par fichier') }}
                                                                </div>
                                                                <button type="button" class="file-input-btn">
                                                                    <i class="fas fa-cloud-upload-alt"></i> 
                                                                    {{ __('Choisir les fichiers') }}
                                                                </button>
                                                                <input type="file" name="documents[{{$document->id}}][]" id="document_{{ $document->id }}" 
                                                                    accept=".pdf,.doc,.docx,image/*" class="file-input-real multiple-file-input" 
                                                                    @if($document->is_required) required @endif multiple>
                                                            </div>
                                                            <div class="file-preview" id="preview_{{ $document->id }}"></div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            ajaxForm('#requestForm');
        });
    </script>
@endpush