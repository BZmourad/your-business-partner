@switch($data->action)
    @case('create') <span class="badge badge-success badge-sm round"> <i class="la la-plus"></i> </span> {{ __("Add")}} @break
    @case('edit') <span class="badge badge-info badge-sm round"> <i class="la la-edit"></i> </span> {{ __("Edit")}} @break
    @case('email') <span class="badge badge-secondary badge-sm round"> <i class="la la-envelope"></i> </span> {{ __("Email")}} @break
    @case('create_account') <span class="badge badge-success badge-sm round"> <i class="la la-user-plus"></i> </span> {{ __("Add account")}} @break
    @case('inactive') <span class="badge badge-warning badge-sm round"> <i class="la la-times-circle"></i> </span> {{ __("Desactivate")}} @break
    @case('active') <span class="badge badge-success badge-sm round"> <i class="la la-check"></i> </span> {{ __("Activate")}} @break
    @case('delete') <span class="badge badge-danger badge-sm round"> <i class="la la-trash"></i> </span> {{ __("Delete")}} @break
    @case('delete_account') <span class="badge badge-danger badge-sm round"> <i class="la la-user-times"></i> </span> {{ __("Delete account")}} @break
    @case('update_form') <span class="badge badge-info badge-sm round"> <i class="la la-pencil-square"></i> </span> {{ __("Update form")}} @break
    @case('unpaid') <span class="badge badge-warning badge-sm round"> <i class="la la-times-circle"></i> </span> {{ __("Unpaid")}} @break
    @case('paid') <span class="badge badge-success badge-sm round"> <i class="la la-check"></i> </span> {{ __("paid")}} @break
    @case('in_progress') <span class="badge badge-info badge-sm round"> <i class="la la-play"></i> </span> {{ __("Démarrer")}} @break
    @case('completed') <span class="badge badge-success badge-sm round"> <i class="la la-check-circle"></i> </span> {{ __("Terminer")}} @break
    @case('refused') <span class="badge badge-danger badge-sm round"> <i class="la la-times"></i> </span> {{ __("Refuser")}} @break
    @case('pending') <span class="badge badge-primary badge-sm round"> <i class="la la-pause"></i> </span> {{ __("Suspendre")}} @break
    @case('comment') <span class="badge badge-success badge-sm round"> <i class="la la-comments"></i> </span> {{ __("Comment")}} @break
    @case('delete_comment') <span class="badge badge-danger badge-sm round"> <i class="la la-trash"></i> </span> {{ __("Delete comment")}} @break
    @case('visible_comment') <span class="badge badge-primary badge-sm round"> <i class="la la-eye"></i> </span> {{ __("Rendre visible un commentaire")}} @break
    @case('invisible_comment') <span class="badge badge-warning badge-sm round"> <i class="la la-eye-slash"></i> </span> {{ __("Masquer commentaire")}} @break   
    @case('attach_month') <span class="badge badge-success badge-sm round"> <i class="la la-calendar"></i> </span> {{ __("Associer un mois")}} @break
    @case('dettach_month') <span class="badge badge-danger badge-sm round"> <i class="la la-calendar"></i> </span> {{ __("Désassocier un mois")}} @break  
    @case('upload_media') <span class="badge badge-primary badge-sm round"> <i class="la la-upload"></i> </span> {{ __("Upload files")}} @break   
    @case('permission') <span class="badge badge-primary badge-sm round"> <i class="la la-key"></i> </span> {{ __("Update permission")}} @break   
    @case('download') <span class="badge badge-primary badge-sm round"> <i class="la la-download"></i> </span> {{ __("Download")}} @break  
    @case('documents') <span class="badge badge-info badge-sm round"> <i class="la la-folder-open"></i> </span> {{ __("Update documents")}} @break
    @case('logo') <span class="badge badge-info badge-sm round"> <i class="la la-image"></i> </span> {{ __("Update logo")}} @break
    @case('company') <span class="badge badge-info badge-sm round"> <i class="la la-building"></i> </span> {{ __("Update company information")}} @break
    @default
        {{ $data->action }}
@endswitch
