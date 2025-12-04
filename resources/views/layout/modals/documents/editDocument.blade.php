<div class="modal animated bounceInUp text-left" id="editDocumentModal" tabindex="-1" role="dialog" aria-labelledby="editDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <i class="la la-edit"></i> {{ __("Edit document")}} </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-2 pb-3">
                <form id="editDocumentForm" method="POST" action="{{ route(auth()->user()->type.'.documents.updateDocument') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{isset($document) ? $document->id : ''}}">
                    <div class="row">
                        <div class="{{isset($mode) ? 'col-md-12' : 'col-md-8'}} form-group">
                            <label for="name">{{ __('Name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" value="{{isset($document) ? $document->name : ''}}" required autocomplete="off" list="docsname">
                        </div>
                        @if (isset($mode))
                            <input type="hidden" name="request_id" id="request_id" value="{{$request->id}}">
                        @else
                            <div class="col-md-4 form-group">
                                <label for="request_id">{{ __('Request') }}</label>
                                <select class="form-control select2" id="request_id" name="request_id">
                                    <option value="">{{ __('All') }}</option>
                                    @foreach ($requests as $item)
                                        <option value="{{$item->id}}" {{(isset($document) &&($document->request_id == $item->id)) ? 'selected' : ''}} >{{ $item->reference }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="col-md-12 form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <textarea name="description" id="description" class="form-control" rows="3">{{isset($document) ? $document->description : ''}}</textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="editDocumentForm" class="btn btn-success"><i class="fas fa-check"></i> {{ __('Save') }}</button>
            </div>
        </div>
    </div>
</div>