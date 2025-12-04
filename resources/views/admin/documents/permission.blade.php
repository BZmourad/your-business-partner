<div class="modal animated bounceInUp text-left" id="permissionModal" tabindex="-1" role="dialog" aria-labelledby="permissionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <i class="la la-key"></i> {{ __("Permissions")}} </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-2 pb-3">
                <form id="permissionForm" method="POST" action="{{route('admin.documents.permission.update')}}" enctype="multipart/form-data">
                    <input type="hidden" name="document_id" value="{{$document->id}}">
                    @csrf
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered mt-1">
                                <thead class="bg-secondary text-white">
                                    <tr>
                                        <th>{{ __('Users')}}</th>
                                        <th> <i class="la la-eye"></i> {{ __('View')}}</th>
                                        <th> <i class="la la-times"></i> {{ __('Delete')}}</th>
                                        <th> <i class="la la-download"></i> {{ __('Download')}}</th>
                                        <th> <i class="la la-upload"></i> {{ __('Upload')}}</th>
                                        <th> <i class="la la-envelope"></i> {{ __('Email')}}</th>
                                        <th> <i class="la la-comment"></i> {{ __('Comment')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($users)
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{$user->name}} @if($user->customer_id) <span class="badge badge-success"> {{ __('Customer')}} </span> @endif </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="auth-has_view{{$user->id}}" class="custom-control-input" value="1" 
                                                            name="permissions[{{$user->id}}][has_view]"
                                                            {{$document->userPermission($user) && $document->userPermission($user)->has_view ? 'checked' : ''}}>
                                                        <label class="custom-control-label" for="auth-has_view{{$user->id}}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="auth-has_delete{{$user->id}}" class="custom-control-input" value="1" 
                                                            name="permissions[{{$user->id}}][has_delete]"
                                                            {{$document->userPermission($user) && $document->userPermission($user)->has_delete ? 'checked' : ''}}>
                                                        <label class="custom-control-label" for="auth-has_delete{{$user->id}}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="auth-has_download{{$user->id}}" class="custom-control-input" value="1" 
                                                            name="permissions[{{$user->id}}][has_download]"
                                                            {{$document->userPermission($user) && $document->userPermission($user)->has_download ? 'checked' : ''}}>
                                                        <label class="custom-control-label" for="auth-has_download{{$user->id}}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="auth-has_upload_files{{$user->id}}" class="custom-control-input" value="1"  
                                                            name="permissions[{{$user->id}}][has_upload_files]"
                                                            {{$document->userPermission($user) && $document->userPermission($user)->has_upload_files ? 'checked' : ''}}>
                                                        <label class="custom-control-label" for="auth-has_upload_files{{$user->id}}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="auth-has_send_by_email{{$user->id}}" class="custom-control-input" value="1"  
                                                            name="permissions[{{$user->id}}][has_send_by_email]"
                                                            {{$document->userPermission($user) && $document->userPermission($user)->has_send_by_email ? 'checked' : ''}}>
                                                        <label class="custom-control-label" for="auth-has_send_by_email{{$user->id}}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="auth-has_comment{{$user->id}}" class="custom-control-input" value="1"  
                                                            name="permissions[{{$user->id}}][has_comment]"
                                                            {{$document->userPermission($user) && $document->userPermission($user)->has_comment ? 'checked' : ''}}>
                                                        <label class="custom-control-label" for="auth-has_comment{{$user->id}}"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="permissionForm" class="btn btn-success"><i class="fas fa-check"></i> {{ __('Save') }}</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            // Fonction pour vérifier et gérer l'état de has_view
            function updateHasViewState(userId) {
                const hasView = $('#auth-has_view' + userId);
                const hasDelete = $('#auth-has_delete' + userId);
                const hasDownload = $('#auth-has_download' + userId);
                const hasUpload = $('#auth-has_upload_files' + userId);
                const hasSendEmail = $('#auth-has_send_by_email' + userId);
                const hasComment = $('#auth-has_comment' + userId);
                
                // Vérifier si au moins une des permissions est cochée
                const hasAnyPermission = hasDelete.is(':checked') || 
                                    hasDownload.is(':checked') || 
                                    hasUpload.is(':checked') || 
                                    hasSendEmail.is(':checked') || 
                                    hasComment.is(':checked');
                
                if (hasAnyPermission) {
                    // Si une permission est cochée, forcer has_view à être coché
                    hasView.prop('checked', true);
                } else {
                    // Si aucune permission n'est cochée, permettre la modification de has_view
                    hasView.prop('disabled', false);
                }
            }
            
            // Appliquer la logique au chargement de la page pour chaque utilisateur
            @foreach ($users as $user)
                updateHasViewState({{$user->id}});
            @endforeach
            
            // Écouter les changements sur les checkboxes de permissions
            $('input[id^="auth-has_delete"], input[id^="auth-has_download"], input[id^="auth-has_upload_files"], input[id^="auth-has_send_by_email"], input[id^="auth-has_comment"]').on('change', function() {
                // Extraire l'ID de l'utilisateur depuis l'ID de la checkbox
                const id = $(this).attr('id');
                const userId = id.replace('auth-has_delete', '')
                                .replace('auth-has_download', '')
                                .replace('auth-has_upload_files', '')
                                .replace('auth-has_send_by_email', '')
                                .replace('auth-has_comment', '');
                
                updateHasViewState(userId);
            });
            
            // Empêcher la désélection manuelle de has_view quand il est forcé
            $('input[id^="auth-has_view"]').on('change', function() {
                const id = $(this).attr('id');
                const userId = id.replace('auth-has_view', '');
                
                updateHasViewState(userId);
            });
        });
    </script>
@endpush