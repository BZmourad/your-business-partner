<div class="modal animated bounceInUp text-left" id="uploadMediaModal" tabindex="-1" role="dialog" aria-labelledby="uploadMediaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <i class="la la-link"></i> {{ __("Upload files")}} </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-2 pb-3">
                <form id="uploadMediaForm" method="POST" action="{{ route(auth()->user()->type.'.documents.media.upload') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{isset($document) ? $document->id : ''}}">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <div class="file-input-wrapper">
                                <div class="file-input-custom file-input-multiple" id="custom_upload">
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
                                    <input type="file" name="documents[]" id="document_upload" accept=".pdf,.doc,.docx,image/*" class="file-input-real multiple-file-input" required multiple>
                                </div>
                                <div class="file-preview" id="preview_upload"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="uploadMediaForm" class="btn btn-success"><i class="fas fa-check"></i> {{ __('Save') }}</button>
            </div>
        </div>
    </div>
</div>