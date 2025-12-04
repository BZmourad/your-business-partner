@extends('layout.app')

@section('title', __('Services'))
@section('data_col', "2-columns")
@section('body_class', "2-columns")
@section('active_services', "active")

@push('styles')
    @include('layout.partials.styles.nav')
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
                                <li class="breadcrumb-item active">{{ isset($service) ? __('Edit') : __('Add') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                        <a href="{{ route('admin.services.index') }}" class="btn btn-warning">
                            <i class="la la-list"></i> {{ __('Services')}}
                        </a>
                        <button type="submit" form="serviceForm" class="btn btn-success">
                            <i class="fas fa-check"></i> {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </div>
            <div class="content-body pb-5">
                <form id="serviceForm" method="POST" action="{{ isset($service) ? route('admin.services.update', $service->id) : route('admin.services.store') }}">
                    @csrf
                    @if(isset($service))
                        @method('PUT')
                    @endif
                    
                    <div class="row">
                        <div class="col-12">
                            <ul class="nav nav-tabs nav-justified bg-white shadow-sm">
                                <li class="nav-item">
                                    <a class="nav-link font-medium-3 active" id="info-tab" data-toggle="tab" href="#info" aria-controls="info" aria-expanded="true">
                                        <i class="fas fa-info-circle mr-1"></i> {{ __('Informations') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link font-medium-3" id="documents-tab" data-toggle="tab" href="#documents" aria-controls="documents" aria-expanded="false">
                                        <i class="fas fa-file-alt mr-1"></i> {{ __('Documents') }}
                                    </a>
                                </li>
                                <li class="nav-item font-medium-3">
                                    <a class="nav-link" id="fields-tab" data-toggle="tab" href="#fields" aria-controls="fields">
                                        <i class="fas fa-list-alt mr-1"></i> {{ __('Champs') }}
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content pt-1">
                                <div role="tabpanel" class="tab-pane active" id="info" aria-labelledby="info-tab" aria-expanded="true">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="name">{{ __('Nom du service') }} <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $service->name ?? '') }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="description">{{ __('Description') }}</label>
                                                            <textarea class="form-control" id="description" name="description" rows="10">{!! old('description', $service->description ?? '') !!}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="documents" role="tabpanel" aria-labelledby="documents-tab" aria-expanded="false">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="repeater-default">
                                                    <div data-repeater-list="documents">
                                                        @if(isset($service) && $service->documents->count() > 0)
                                                            @foreach($service->documents as $document)
                                                                <div data-repeater-item>
                                                                    <input type="hidden" name="documents[{{ $loop->index }}][id]" value="{{ $document->id }}">
                                                                    <div class="row">
                                                                        <div class="form-group col-md-4">
                                                                            <label for="document_name">{{ __('Nom') }} <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" name="documents[{{ $loop->index }}][name]" 
                                                                                value="{{ old('documents.'.$loop->index.'.name', $document->name) }}" required autocomplete="off" list="docsname">
                                                                        </div>
                                                                        <div class="form-group col-md-5">
                                                                            <label for="document_description">{{ __('Description') }}</label>
                                                                            <textarea class="form-control" name="documents[{{ $loop->index }}][description]" rows="2">{{ old('documents.'.$loop->index.'.description', $document->description) }}</textarea>
                                                                        </div>
                                                                        <div class="form-group col-md-2">
                                                                            <div class="skin skin-square mt-3">
                                                                                <fieldset>
                                                                                    <input type="checkbox" name="documents[{{ $loop->index }}][is_required]" value="1" {{ $document->is_required ? 'checked' : '' }}>
                                                                                    <label>{{ __('Obligatoire') }}</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-md-1">
                                                                            <button type="button" class="btn btn-danger mt-2" data-repeater-delete> 
                                                                                <i class="ft-x"></i> 
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <div data-repeater-item>
                                                                <div class="row">
                                                                    <div class="form-group col-md-4">
                                                                        <label for="document_name">{{ __('Nom') }} <span class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control" name="name" required autocomplete="off" list="docsname">
                                                                    </div>
                                                                    <div class="form-group col-md-5">
                                                                        <label for="document_description">{{ __('Description') }}</label>
                                                                        <textarea class="form-control" name="description" rows="2"></textarea>
                                                                    </div>
                                                                    <div class="form-group col-md-2">
                                                                        <div class="skin skin-square mt-3">
                                                                            <fieldset>
                                                                                <input type="checkbox" name="is_required" value="1">
                                                                                <label>{{ __('Obligatoire') }}</label>
                                                                            </fieldset>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-1">
                                                                        <button type="button" class="btn btn-danger mt-2" data-repeater-delete> 
                                                                            <i class="ft-x"></i> 
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="form-group overflow-hidden">
                                                        <div class="col-12">
                                                            <button type="button" data-repeater-create class="btn btn-primary">
                                                                <i class="ft-plus"></i> {{ __('Ajouter un document') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="fields" role="tabpanel" aria-labelledby="fields-tab" aria-expanded="false">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="repeater-default">
                                                    <div data-repeater-list="fields">
                                                        @if(isset($service) && $service->fields->count() > 0)
                                                            @foreach($service->fields as $field)
                                                                <div data-repeater-item>
                                                                    <input type="hidden" name="fields[{{ $loop->index }}][id]" value="{{ $field->id }}">
                                                                    <div class="row">
                                                                        <div class="form-group col-md-3">
                                                                            <label for="field_name">{{ __('Nom') }} <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" name="fields[{{ $loop->index }}][name]" 
                                                                                value="{{ old('fields.'.$loop->index.'.name', $field->name) }}" required>
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label for="field_type">{{ __('Type') }} <span class="text-danger">*</span></label>
                                                                            <select class="form-control field-type-select" name="fields[{{ $loop->index }}][type]" required>
                                                                                <option value="short_text" {{ old('fields.'.$loop->index.'.type', $field->type) == 'short_text' ? 'selected' : '' }}>{{ __('Texte court') }}</option>
                                                                                <option value="long_text" {{ old('fields.'.$loop->index.'.type', $field->type) == 'long_text' ? 'selected' : '' }}>{{ __('Texte long') }}</option>
                                                                                <option value="number" {{ old('fields.'.$loop->index.'.type', $field->type) == 'number' ? 'selected' : '' }}>{{ __('Nombre') }}</option>
                                                                                <option value="date" {{ old('fields.'.$loop->index.'.type', $field->type) == 'date' ? 'selected' : '' }}>{{ __('Date') }}</option>
                                                                                <option value="datetime" {{ old('fields.'.$loop->index.'.type', $field->type) == 'datetime' ? 'selected' : '' }}>{{ __('Date et heure') }}</option>
                                                                                <option value="single_select" {{ old('fields.'.$loop->index.'.type', $field->type) == 'single_select' ? 'selected' : '' }}>{{ __('Sélection simple') }}</option>
                                                                                <option value="multiple_select" {{ old('fields.'.$loop->index.'.type', $field->type) == 'multiple_select' ? 'selected' : '' }}>{{ __('Sélection multiple') }}</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label for="field_description">{{ __('Description') }}</label>
                                                                            <textarea class="form-control" name="fields[{{ $loop->index }}][description]" rows="2">{{ old('fields.'.$loop->index.'.description', $field->description) }}</textarea>
                                                                        </div>
                                                                        <div class="form-group col-md-2">
                                                                            <div class="skin skin-square mt-3">
                                                                                <fieldset>
                                                                                    <input type="checkbox" name="fields[{{ $loop->index }}][is_required]" value="1" {{$field->is_required ? 'checked' : '' }}>
                                                                                    <label>{{ __('Obligatoire') }}</label>
                                                                                </fieldset>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-md-11 options-row" style="{{ !in_array(old('fields.'.$loop->index.'.type', $field->type), ['single_select', 'multiple_select']) ? 'display: none;' : '' }}">
                                                                            <label for="field_options">{{ __("Options (séparer par comma',')") }} <span class="text-danger">*</span></label>
                                                                            <textarea class="form-control" name="fields[{{ $loop->index }}][options]" rows="3">{{ old('fields.'.$loop->index.'.options', $field->options) }}</textarea>
                                                                        </div>
                                                                        <div class="form-group col-md-1 text-right">
                                                                            <button type="button" class="btn btn-danger mt-2" data-repeater-delete> 
                                                                                <i class="ft-x"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <div data-repeater-item>
                                                                <div class="row">
                                                                    <div class="form-group col-md-3">
                                                                        <label for="field_name">{{ __('Nom') }} <span class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control" name="name" required>
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label for="field_type">{{ __('Type') }} <span class="text-danger">*</span></label>
                                                                        <select class="form-control field-type-select" name="type" required>
                                                                            <option value="short_text">{{ __('Texte court') }}</option>
                                                                            <option value="long_text">{{ __('Texte long') }}</option>
                                                                            <option value="number">{{ __('Nombre') }}</option>
                                                                            <option value="date">{{ __('Date') }}</option>
                                                                            <option value="datetime">{{ __('Date et heure') }}</option>
                                                                            <option value="single_select">{{ __('Sélection simple') }}</option>
                                                                            <option value="multiple_select">{{ __('Sélection multiple') }}</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label for="field_description">{{ __('Description') }}</label>
                                                                        <textarea class="form-control" name="description" rows="2"></textarea>
                                                                    </div>
                                                                    <div class="form-group col-md-2">
                                                                        <div class="skin skin-square mt-3">
                                                                            <fieldset>
                                                                                <input type="checkbox" name="is_required" value="1">
                                                                                <label>{{ __('Obligatoire') }}</label>
                                                                            </fieldset>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-11 options-row" style="display: none;">
                                                                        <label for="field_options">{{ __("Options (séparer par comma',')") }} <span class="text-danger">*</span></label>
                                                                        <textarea class="form-control" name="options" rows="3"></textarea>
                                                                    </div>
                                                                    <div class="form-group col-md-1 text-right">
                                                                        <button type="button" class="btn btn-danger mt-2" data-repeater-delete> 
                                                                            <i class="ft-x"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="form-group overflow-hidden">
                                                        <div class="col-12">
                                                            <button type="button" data-repeater-create class="btn btn-primary">
                                                                <i class="ft-plus"></i> {{ __('Ajouter un champ') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('modern-admin/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.repeater-default').repeater({
                show: function() {
                    initFieldTypeEvents();
                    $(".skin-square input").iCheck({
                        checkboxClass: "icheckbox_square-green",
                        radioClass: "iradio_square-green"
                    });
                    $(this).slideDown();
                },
                hide: function(deleteElement) {
                    if(confirm("{{ __('Are you sure you want to remove this item?')}}")) {
                        $(this).slideUp(deleteElement);
                    }
                },
                ready: function() {
                    // Initialize field type change events for new items
                    initFieldTypeEvents();
                }
            });
            function initFieldTypeEvents() {
                $('.field-type-select').off('change').on('change', function() {
                    var optionsRow = $(this).closest('.row').find('.options-row');
                    if ($(this).val() === 'single_select' || $(this).val() === 'multiple_select') {
                        optionsRow.slideDown();
                    } else {
                        optionsRow.slideUp();
                    }
                });
            }
            initFieldTypeEvents();
        });
    </script>
    <script>
        $(document).ready(function() {
            ajaxForm('#serviceForm');
            $(".skin-square input").iCheck({
                checkboxClass: "icheckbox_square-green",
                radioClass: "iradio_square-green"
            });
        });
    </script>
@endpush