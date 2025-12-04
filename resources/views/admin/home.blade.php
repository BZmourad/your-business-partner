@extends('layout.app')

@section('title', __('Dashboard'))
@section('data_col', "2-columns")
@section('body_class', "2-columns")
@section('active_dashboard', "active")

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css/pages/users.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css/pages/timeline.min.css') }}">
    <style>
        .profile-card-with-cover .card-profile-image {
            position: unset !important;
        }
    </style>
@endpush

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('Dashboard') }}</h3>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                        <a href="{{ route('admin.profile') }}" class="btn btn-blue">
                            <i class="fas fa-edit"></i> {{ __("Edit profile")}}
                        </a>
                    </div>
                </div>
            </div>
            <div class="content-body pb-5">
                <div class="row match-height">
                    <div class="col-md-6">
                        @include('admin.users.fiche', ['user' => auth()->user()])
                    </div>
                    <div class="col-md-6">
                        <section id="timeline" class="timeline-left timeline-wrapper">
                            <ul class="timeline">
                                <li class="timeline-line"></li>
                                @foreach ($timelineToday as $item)
                                    @php
                                        $icon = "";
                                        $text = "";
                                        $color = "";
                                        switch($item->action){
                                            case 'create': $color = "success"; $icon = "la la-plus"; $text = __("Add"); break;
                                            case 'edit': $color = "info"; $icon = "la la-edit"; $text = __("Edit"); break;
                                            case 'email': $color = "secondary"; $icon = "la la-envelope"; $text = __("Email"); break;
                                            case 'create_account': $color = "success"; $icon = "la la-user-plus"; $text = __("Add account"); break;
                                            case 'inactive': $color = "warning"; $icon = "la la-times-circle"; $text = __("Desactivate"); break;
                                            case 'active': $color = "success"; $icon = "la la-check"; $text = __("Activate"); break;
                                            case 'delete': $color = "danger"; $icon = "la la-trash"; $text = __("Delete"); break;
                                            case 'delete_account': $color = "danger"; $icon = "la la-user-times"; $text = __("Delete account"); break;
                                            case 'update_form': $color = "info"; $icon = "la la-pencil-square"; $text = __("Update form"); break;
                                            case 'unpaid': $color = "warning"; $icon = "la la-times-circle"; $text = __("Unpaid"); break;
                                            case 'paid': $color = "success"; $icon = "la la-check"; $text = __("paid"); break;
                                            case 'in_progress': $color = "info"; $icon = "la la-play"; $text = __("Démarrer"); break;
                                            case 'completed': $color = "success"; $icon = "la la-check-circle"; $text = __("Terminer"); break;
                                            case 'refused': $color = "danger"; $icon = "la la-times"; $text = __("Refuser"); break;
                                            case 'pending': $color = "primary"; $icon = "la la-pause"; $text = __("Suspendre"); break;
                                            case 'comment': $color = "success"; $icon = "la la-comments"; $text = __("Comment"); break;
                                            case 'delete_comment': $color = "danger"; $icon = "la la-trash"; $text = __("Delete comment"); break;
                                            case 'visible_comment': $color = "primary"; $icon = "la la-eye"; $text = __("Rendre visible un commentaire"); break;
                                            case 'invisible_comment': $color = "warning"; $icon = "la la-eye-slash"; $text = __("Masquer commentaire"); break;   
                                            case 'attach_month': $color = "success"; $icon = "la la-calendar"; $text = __("Associer un mois"); break;
                                            case 'dettach_month': $color = "danger"; $icon = "la la-calendar"; $text = __("Désassocier un mois"); break;  
                                            case 'upload_media': $color = "primary"; $icon = "la la-upload"; $text = __("Upload files"); break;   
                                            case 'permission': $color = "primary"; $icon = "la la-key"; $text = __("Update permission"); break;   
                                            case 'download': $color = "primary"; $icon = "la la-download"; $text = __("Download"); break;  
                                            case 'documents': $color = "info"; $icon = "la la-folder-open"; $text = __("Update documents"); break;
                                            case 'logo': $color = "info"; $icon = "la la-image"; $text = __("Update logo"); break;
                                            case 'company': $color = "info"; $icon = "la la-building"; $text = __("Update company information"); break;
                                        }
                                        $text = $text." <strong> ".__(ucfirst($item->module))." </strong>";
                                    @endphp
                                    <li class="timeline-item">
                                        <div class="timeline-badge"><span class="bg-{{$color}}"> <i class="{{$icon}}"></i> </span></div>
                                        <div class="timeline-card mb-0 card border-grey border-lighten-2">
                                            <div class="card-header p-1">
                                                <h4 class="card-title">{!! $text !!}</h4>
                                                <p class="card-subtitle text-muted pt-1"><span class="font-small-3">{{ $item->created_at->diffForHumans() }}</span></p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('modern-admin/app-assets/js/scripts/cards/card-social.min.js') }}"></script>
@endpush