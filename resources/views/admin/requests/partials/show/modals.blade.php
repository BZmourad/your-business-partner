<div class="modal animated bounceInUp text-left" id="setStatusModal" tabindex="-1" role="dialog" aria-labelledby="setStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-2 pb-3">
                <form id="setStatusForm" method="POST" action="{{ route('admin.requests.setStatus') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$request->id}}">
                    <input type="hidden" name="status" id="status">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="notes">{{ __('Note') }}</label>
                            <textarea name="notes" id="notes" class="form-control" rows="8"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="setStatusForm" class="btn btn-success"><i class="fas fa-check"></i> {{ __('Save') }}</button>
            </div>
        </div>
    </div>
</div>
<div class="modal animated bounceInUp text-left" id="setPaidStatusModal" tabindex="-1" role="dialog" aria-labelledby="setPaidStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-2 pb-3">
                <form id="setPaidStatusForm" method="POST" action="{{ route('admin.requests.setPaidStatus') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$request->id}}">
                    <input type="hidden" name="status" id="status">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="notes">{{ __('Note') }}</label>
                            <textarea name="notes" id="notes" class="form-control" rows="8"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="setPaidStatusForm" class="btn btn-success"><i class="fas fa-check"></i> {{ __('Save') }}</button>
            </div>
        </div>
    </div>
</div>
<div class="modal animated bounceInUp text-left" id="updateFormsModal" tabindex="-1" role="dialog" aria-labelledby="updateFormsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <i class="la la-link"></i> {{ __("Modifier Formulaire")}} </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-2 pb-3">
                <form id="updateFormsForm" method="POST" action="{{ route('admin.requests.updateForm') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="request_id" value="{{$request->id}}">
                    <div class="row">
                        @foreach ($request->fields as $field)
                            <div class="col-md-12 mt-1">
                                <label for="field_{{ $field->id }}">{{ $field->name }} @if($field->is_required)<span class="text-danger">*</span>@endif</label>
                                @if ($field->type == "short_text")
                                    <input type="text" name="fields[{{ $field->id }}]" id="field_{{ $field->id }}" class="form-control" value="{{$field->response}}" @if($field->is_required) required @endif>
                                @elseif ($field->type == "long_text")
                                    <textarea name="fields[{{ $field->id }}]" id="field_{{ $field->id }}" class="form-control" @if($field->is_required) required @endif rows="4">{{$field->response}}</textarea>
                                @elseif ($field->type == "number")
                                    <input type="number" name="fields[{{ $field->id }}]" id="field_{{ $field->id }}" value="{{$field->response}}" class="form-control" @if($field->is_required) required @endif>
                                @elseif ($field->type == "date")
                                    <input type="date" name="fields[{{ $field->id }}]" id="field_{{ $field->id }}" value="{{$field->response}}" class="form-control" @if($field->is_required) required @endif>
                                @elseif ($field->type == "datetime")
                                    <input type="datetime-local" name="fields[{{ $field->id }}]" value="{{$field->response}}" id="field_{{ $field->id }}" class="form-control" @if($field->is_required) required @endif>
                                @elseif ($field->type == "single_select")
                                    @php
                                        $options = explode(',', $field->options);
                                    @endphp
                                    @if ($options)
                                        <select name="fields[{{ $field->id }}]" id="field_{{ $field->id }}" class="form-control" @if($field->is_required) required @endif>
                                            <option value="">{{ __('Sélectionner une option') }}</option>
                                            @foreach ($options as $item)
                                                <option value="{{ $item }}" @if($item == $field->response) selected @endif>{{ $item }}</option>
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
                                                <option value="{{ $item }}" @if(array_in($item, explode(',', $field->response))) selected @endif>{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                @endif
                                @if ($field->description) <small class="form-text text-muted"> {!! $field->description !!} </small> @endif
                            </div>
                        @endforeach
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="updateFormsForm" class="btn btn-success"><i class="fas fa-check"></i> {{ __('Save') }}</button>
            </div>
        </div>
    </div>
</div>
<div class="modal animated bounceInUp text-left" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-2 pb-3">
                <div class="row">
                    <div class="col-12 form-group">
                        <fieldset>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-year-2">{{ __('Year')}}</span>
                                </div>
                                <select name="year" id="year2" class="form-control" aria-describedby="basic-year-2">
                                    <option value=""></option>
                                    @for ($i = 2000; $i <= 2050; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-12 form-group">
                        <fieldset>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-month-2">{{ __('Month')}}</span>
                                </div>
                                <select name="month" id="month2" class="form-control" aria-describedby="basic-month-2">
                                    <option value=""></option>
                                    @foreach ([['janvier', 1],['février', 2],['mars', 3],['avril', 4],['mai', 5],['juin', 6],['juillet', 7],['août', 8],['septembre', 9],['octobre', 10],['novembre', 11],['décembre', 12]] as $item)
                                        <option value="{{$item[1]}}">{{$item[0]}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.modals.documents.addDocument')
@include('layout.modals.documents.editDocument')
<div class="modal animated bounceInUp text-left" id="docMonthModal" tabindex="-1" role="dialog" aria-labelledby="docMonthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <i class="la la-calendar"></i> {{ __("Affecter à un mois")}} </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-2 pb-3">
                <form id="docMonthForm" method="POST" action="{{ route('admin.documents.setMonth') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id" >
                    <div class="row mt-5">
                        <div class="col-md-6 form-group">
                            <fieldset>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-year">{{ __('Year')}}</span>
                                    </div>
                                    <select name="year" id="year" class="form-control" aria-describedby="basic-year">
                                        <option value=""></option>
                                        @for ($i = 2000; $i <= 2050; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-6 form-group">
                            <fieldset>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-month">{{ __('Month')}}</span>
                                    </div>
                                    <select name="month" id="month" class="form-control" aria-describedby="basic-month">
                                        <option value=""></option>
                                        @foreach ([['janvier', 1],['février', 2],['mars', 3],['avril', 4],['mai', 5],['juin', 6],['juillet', 7],['août', 8],['septembre', 9],['octobre', 10],['novembre', 11],['décembre', 12]] as $item)
                                            <option value="{{$item[1]}}">{{$item[0]}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="docMonthForm" class="btn btn-primary"><i class="la la-save"></i> {{ __('Save') }}</button>
            </div>
        </div>
    </div>
</div>