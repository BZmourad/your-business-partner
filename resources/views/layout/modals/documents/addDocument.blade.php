<div class="modal animated bounceInUp text-left" id="addDocumentModal" tabindex="-1" role="dialog" aria-labelledby="addDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <i class="la la-plus"></i> {{ __("Add document")}} </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-2 pb-3">
                <form id="addDocumentForm" method="POST" action="{{ route(auth()->user()->type.'.documents.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="{{isset($mode) ? 'col-md-12' : 'col-md-8'}} form-group">
                            <label for="name">{{ __('Name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" required autocomplete="off" list="docsname">
                        </div>
                        @if (isset($mode))
                            <input type="hidden" name="request_id" id="request_id" value="{{$request->id}}">
                        @else
                            <div class="col-md-4 form-group">
                                <label for="request_id">{{ __('Request') }} @if(auth()->user()->type == 'customer') <span class="text-danger">*</span> @endif</label>
                                <select class="form-control select2" id="request_id" name="request_id" @if(auth()->user()->type == 'customer') required @endif>
                                    <option value="">{{ __('All') }}</option>
                                    @foreach ($requests as $item)
                                        <option value="{{$item->id}}">{{ $item->reference }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="col-md-12 form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <div class="file-input-wrapper">
                                <div class="file-input-custom file-input-multiple" id="custom_join">
                                    <div class="file-input-text">
                                        <div class="file-category-name">{{ __("Drop files here to upload") }} <span class="text-danger">*</span></div>
                                        <div class="select-number-files"></div>
                                    </div>
                                    <div class="file-input-hint">
                                        {{ __('Formats acceptés: PDF, DOC, DOCX, JPG, PNG') }}<br>
                                        {{ __('Taille max: 5MB') }} {{ __('par fichier') }}
                                    </div>
                                    <button type="button" class="file-input-btn">
                                        <i class="fas fa-cloud-upload-alt"></i> 
                                        {{ __('Choisir les fichiers') }}
                                    </button>
                                    <input type="file" name="documents[]" id="document_join" accept=".pdf,.doc,.docx,image/*" class="file-input-real multiple-file-input" required multiple>
                                </div>
                                <div class="file-preview" id="preview_join"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="addDocumentForm" class="btn btn-success"><i class="fas fa-check"></i> {{ __('Save') }}</button>
            </div>
        </div>
    </div>
</div>