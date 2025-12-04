@extends('layout.app')

@section('title', __('Customers'))
@section('data_col', "2-columns")
@section('body_class', "2-columns")
@section('active_customers', "active")

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/tables/datatable/select.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/tables/extensions/colReorder.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/tables/extensions/fixedHeader.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/editors/summernote.css') }}">
    <style>
        table.dataTable.no-footer {
            border-bottom: none !important;
        }
        #filterModal .modal-header{
            border-bottom: none !important;
        }
    </style>
@endpush

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">{{ __('Customers') }}</h3>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right">
                    <a href="{{ route('admin.customers.create') }}" class="btn btn-success">
                        <i class="fa fa-plus"></i> {{ __("Add")}}
                    </a>
                    <button class="btn btn-secondary" data-toggle="modal" data-target="#filterModal"> <i class="la la-filter"></i> {{ __("Filter")}} </button>
                </div>
            </div>
        </div>
        <div class="content-body pb-5">
            <section class="mb-5">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <table class="table table-bordered dataex-res-constructor">
                                        <thead class="text-uppercase text-center bg-blue-dark text-white">
                                            <tr>
                                                <th> {{ __('ID')}} </th>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Type') }}</th>
                                                <th>{{ __('Email') }}</th>
                                                <th>{{ __('Identity') }}</th>
                                                <th>{{ __('Has account?') }}</th>
                                                <th> {{ __('Crée Le')}} </th>
                                                <th> {{ __('Demandes')}} </th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
                        <label for="customer_type">{{ __('Type de client') }}</label>
                        <select class="form-control" id="customer_type" name="customer_type">
                            <option value="">{{ __('All') }}</option>
                            <option value="particulier">{{ __('Particulier') }}</option>
                            <option value="entreprise">{{ __('Entreprise') }}</option>
                        </select>
                    </div>
                    <div class="col-12 form-group mt-2">
                        <label for="has_account">{{ __('Has account?') }}</label>
                        <select class="form-control" id="has_account" name="has_account">
                            <option value="">{{ __('All') }}</option>
                            <option value="yes">{{ __('Yes') }}</option>
                            <option value="no">{{ __('No') }}</option>
                        </select>
                    </div>
                    <div class="col-12 form-group mt-2">
                        <label for="id_type">{{ __('Type de pièce d\'identité') }}</label>
                        <select class="form-control" id="id_type" name="id_type">
                            <option value="">{{ __('All') }}</option>
                            <option value="cin">{{ __('CIN') }}</option>
                            <option value="passport">{{ __('Passeport') }}</option>
                            <option value="other">{{ __('Other') }}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal animated bounceInUp text-left" id="addAccountModal" tabindex="-1" role="dialog" aria-labelledby="addAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <i class="la la-user-plus"></i>  {{ __("Add account")}} </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-2 pb-3">
                <form id="addAccountForm" method="POST" action="{{ route('admin.customers.addAccount') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="customer_id" id="customer_id">
                    <div class="row skin skin-square mb-2">
                        <div class="col-md-12">
                            <fieldset>
                                <input type="checkbox" id="user_send_email" name="user_send_email" value="1">
                                <label for="user_send_email">{{ __('Send access parameters by email')}}</label>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 position-relative">
                            <label for="password" class="form-label">{{ __('Password') }} <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('Entrez votre mot de passe') }}">
                                <button type="button" class="btn btn-outline-dark generate-password">
                                    <i class="fas fa-random"></i>
                                </button>
                                <button type="button" class="btn btn-outline-dark toggle-password" data-target="password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-12 position-relative mt-1">
                            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{{ __('Confirmez votre mot de passe') }}">
                                <button type="button" class="btn btn-outline-dark toggle-password" data-target="password_confirmation">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-12 mt-1">
                            <div class="row justify-content-md-center">
                                <div class="col-lg-12 p-1 shadow-lg">
                                    <div class="validation-container container">
                                        <div class="progress" style="height: 10px;">
                                            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div>
                                            <div class="requirement" id="length-req">
                                                <i class="fas fa-times-circle text-danger"></i> {{ __("Au moins 8 caractères")}}
                                            </div>
                                            <div class="requirement" id="lowercase-req">
                                                <i class="fas fa-times-circle text-danger"></i> {{ __("Lettres minuscules")}}
                                            </div>
                                            <div class="requirement" id="uppercase-req">
                                                <i class="fas fa-times-circle text-danger"></i> {{ __("Lettres majuscules")}}
                                            </div>
                                            <div class="requirement" id="number-req">
                                                <i class="fas fa-times-circle text-danger"></i> {{ __("Au moins un chiffre")}}
                                            </div>
                                            <div class="requirement" id="confirm-req">
                                                <i class="fas fa-times-circle text-danger"></i> {{ __("Confirmation du mot de passe")}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="addAccountForm" class="btn btn-success"><i class="fas fa-check"></i> {{ __('Save') }}</button>
            </div>
        </div>
    </div>
</div>
<div class="modal animated bounceInUp text-left" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <i class="la la-send"></i> {{ __("Envoyer un email")}} </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-2 pb-3">
                <form id="emailForm" method="POST" action="{{ route('admin.customers.sendEmail') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="emailfrom" value="{{ env('MAIL_FROM_ADDRESS') }}">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <fieldset>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-emailfrom">{{ __('From')}}</span>
                                    </div>
                                    <input type="text" class="form-control" id="emailfrom" aria-describedby="basic-emailfrom" value="{{env('MAIL_FROM_ADDRESS')}}" disabled>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-6 form-group">
                            <fieldset>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-emailTo">{{ __('To')}} <span class="text-danger">*</span></span>
                                    </div>
                                    <input type="text" class="form-control" id="emailTo" aria-describedby="basic-emailTo" name="emailTo" required>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-12 form-group">
                            <fieldset>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-emailSubject">{{ __('Subject')}} <span class="text-danger">*</span></span>
                                    </div>
                                    <input type="text" class="form-control" id="emailSubject" aria-describedby="basic-emailSubject" name="emailSubject" required>
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
@endsection

@push('scripts')
    <script src="{{ asset('js/generate-password.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/tables/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/tables/datatable/dataTables.colReorder.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/tables/datatable/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/editors/summernote/summernote.js') }}"></script>
    @include('admin.customers.partials.datatable')
    <script>
        $(document).ready(function() {
            $('#addAccountModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var customerId = button.data('id');
                var modal = $(this);
                modal.find('#customer_id').val(customerId);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".toggle-password").click(function() {
                let target = $("#" + $(this).data("target"));
                let icon = $(this).find("i");

                if (target.attr("type") === "password") {
                    target.attr("type", "text");
                    icon.removeClass("fa-eye").addClass("fa-eye-slash");
                } else {
                    target.attr("type", "password");
                    icon.removeClass("fa-eye-slash").addClass("fa-eye");
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var testBtn = false;
            const passwordInput = document.getElementById('password');
            const confirmInput = document.getElementById('password_confirmation');
            const progressBar = document.querySelector('.progress-bar');
            const requirements = {
                length: document.getElementById('length-req'),
                lowercase: document.getElementById('lowercase-req'),
                uppercase: document.getElementById('uppercase-req'),
                number: document.getElementById('number-req'),
                confirm: document.getElementById('confirm-req')
            };
            
            // Fonction pour vérifier les exigences du mot de passe
            function checkPasswordRequirements(password) {
                const hasLength = password.length >= 8;
                const hasLowercase = /[a-z]/.test(password);
                const hasUppercase = /[A-Z]/.test(password);
                const hasNumber = /[0-9]/.test(password);
                
                return { hasLength, hasLowercase, hasUppercase, hasNumber };
            }
            
            // Fonction pour mettre à jour l'interface utilisateur
            function updateUI(requirementsMet) {
                // Mettre à jour les icônes et couleurs des exigences
                requirements.length.classList.toggle('valid', requirementsMet.hasLength);
                requirements.length.querySelector('i').className = requirementsMet.hasLength ? 
                    'fas fa-check-circle text-success' : 'fas fa-times-circle text-danger';
                
                requirements.lowercase.classList.toggle('valid', requirementsMet.hasLowercase);
                requirements.lowercase.querySelector('i').className = requirementsMet.hasLowercase ? 
                    'fas fa-check-circle text-success' : 'fas fa-times-circle text-danger';
                
                requirements.uppercase.classList.toggle('valid', requirementsMet.hasUppercase);
                requirements.uppercase.querySelector('i').className = requirementsMet.hasUppercase ? 
                    'fas fa-check-circle text-success' : 'fas fa-times-circle text-danger';
                
                requirements.number.classList.toggle('valid', requirementsMet.hasNumber);
                requirements.number.querySelector('i').className = requirementsMet.hasNumber ? 
                    'fas fa-check-circle text-success' : 'fas fa-times-circle text-danger';
                
                // Vérifier la confirmation
                const passwordsMatch = (passwordInput.value === confirmInput.value) && (passwordInput.value !== '');
               
                requirements.confirm.classList.toggle('valid', passwordsMatch);
                requirements.confirm.querySelector('i').className = passwordsMatch ? 
                    'fas fa-check-circle text-success' : 'fas fa-times-circle text-danger';
                
                // Calculer le pourcentage de complétion
                const totalRequirements = 5;
                let metRequirements = Object.values(requirementsMet).filter(Boolean).length;
                
                // Ajouter la confirmation si nécessaire
                if (passwordsMatch) metRequirements++;
                
                const completionPercentage = (metRequirements / totalRequirements) * 100;
                
                // Mettre à jour la barre de progression
                progressBar.style.width = `${completionPercentage}%`;
                
                // Changer la couleur en fonction de la force
                if (completionPercentage <= 20) {
                    progressBar.className = 'progress-bar bg-danger bg-darken-4';
                } else if (completionPercentage <= 40) {
                    progressBar.className = 'progress-bar bg-danger';
                } else if (completionPercentage <= 60){
                    progressBar.className = 'progress-bar bg-danger bg-lighten-1';
                }else if (completionPercentage <= 80){
                    progressBar.className = 'progress-bar bg-warning';
                }else {
                    testBtn = true;
                    progressBar.className = 'progress-bar bg-success';
                }
            }
            
            // Écouter les modifications du mot de passe
            passwordInput.addEventListener('input', function() {
                testBtn = false;
                const password = this.value;
                const requirementsMet = checkPasswordRequirements(password);
                updateUI(requirementsMet);
                
                // Vérifier la confirmation si le champ de confirmation n'est pas vide
                if (confirmInput.value !== '') {
                    checkPasswordMatch();
                }
            });
            
            document.querySelector(".generate-password").addEventListener("click", function () {
                let newPassword = generatePassword();
    
                // Définir le mot de passe et déclencher les événements
                passwordInput.value = newPassword;
                confirmInput.value = newPassword;
                
                // Déclencher manuellement l'événement input
                const event = new Event('input', { bubbles: true });
                passwordInput.dispatchEvent(event);
                const originalType = passwordInput.type;
                passwordInput.type = 'text';
                setTimeout(() => { passwordInput.type = originalType; }, 1000);
    
                // Déclencher manuellement l'événement input
                const event2 = new Event('input', { bubbles: true });
                confirmInput.dispatchEvent(event2);
                const originalType2 = confirmInput.type;
                confirmInput.type = 'text';
                setTimeout(() => { confirmInput.type = originalType2; }, 1000);
            });
    
            // Fonction pour vérifier si les mots de passe correspondent
            function checkPasswordMatch() {
                testBtn = false;
                // Mettre à jour l'UI pour refléter l'état de la confirmation
                const requirementsMet = checkPasswordRequirements(passwordInput.value);
                updateUI(requirementsMet);
            }
    
            confirmInput.addEventListener('input', checkPasswordMatch);
            
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".skin-square input").iCheck({
                checkboxClass: "icheckbox_square-green",
                radioClass: "iradio_square-green"
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#emailModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var email = button.data('email');
                var modal = $(this);
                modal.find('#emailTo').val(email);
                var id = button.data('id');
                modal.find('#id').val(id);
            });
            $('#summernote').summernote({height:250});
        });
    </script>
@endpush