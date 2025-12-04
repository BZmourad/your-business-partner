<div class="modal animated bounceInUp text-left" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <i class="la la-send"></i> {{ __("Envoyer email")}} </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-2 pb-3">
                <form id="emailForm" method="POST" action="{{ route(auth()->user()->type.'.documents.sendEmail') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="document_id" id="document_id" value="{{isset($document) ? $document->id : ''}}">
                    <input type="hidden" name="emailfrom" value="{{ env('MAIL_FROM_ADDRESS') }}">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <fieldset>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-emailfrom">{{ __('From')}}</span>
                                    </div>
                                    <input type="text" class="form-control" id="emailfrom" aria-describedby="basic-emailfrom" value="{{env('MAIL_FROM_ADDRESS')}}" disabled>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-1 form-group">
                            <label for="profession">{{ __('To')}}</label>
                        </div>
                        <div class="col-md-11 form-group">
                            <div class="repeater-default">
                                <div data-repeater-list="emailTo">
                                    <div data-repeater-item>
                                        <fieldset class="mb-1">
                                            <div class="input-group">
                                                <input type="email" class="form-control" name="name" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-danger" type="button" data-repeater-delete><i class="ft-x"></i></button>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="form-group overflow-hidden">
                                    <div class="col-12 text-right">
                                        <button type="button" data-repeater-create class="btn btn-blue"> <i class="ft-plus"></i> {{ __('Ajouter destinataire')}} </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <fieldset>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-emailSubject">{{ __('Subject')}} <span class="text-danger">*</span></span>
                                    </div>
                                    <input type="text" class="form-control" id="emailSubject" aria-describedby="basic-emailSubject" name="emailSubject" value="" required>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <textarea id="summernote" name="message"></textarea>
                    <div class="row">
                        <div class="col-md-12 mb-2 mt-2">
                            <div class="file-input-wrapper">
                                <div class="file-input-custom file-input-multiple" id="custom_upload">
                                    <div class="file-input-text">
                                        <div class="file-category-name">{{ __("Drop files here to upload") }}</div>
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
                                    <input type="file" name="documents[]" id="document_upload" accept=".pdf,.doc,.docx,image/*" class="file-input-real multiple-file-input" multiple>
                                </div>
                                <div class="file-preview" id="preview_upload"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="emailForm" class="btn btn-primary"><i class="la la-send"></i> {{ __('Send') }}</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.repeater-default').repeater({
                show: function() {
                    $(this).slideDown();
                },
                hide: function(deleteElement) {
                    if(confirm("{{ __('Are you sure you want to remove this item?')}}")) {
                        $(this).slideUp(deleteElement);
                    }
                }
            });
        });
    </script>
@endpush