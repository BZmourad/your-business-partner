@extends('layout.app')

@section('title', __('Documents'))
@section('data_col', "2-columns")
@section('body_class', "2-columns")
@section('active_documents', "active")

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/editors/summernote.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css/core/colors/palette-callout.min.css') }}">
    <style>
        .media-item {
            transition: opacity 0.3s ease;
        }
        
        .file-item {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        
        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>
@endpush

@section('content')
    @php
        $fileTypes = [
            'pdf' => ['pdf'],
            'word' => ['doc', 'docx'],
            'image' => ['jpg', 'jpeg', 'png'],
        ]; 
    @endphp
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('Documents') }}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">
                                    [{{ $document->reference }}] 
                                    {{$document->name}} 
                                    <span class="text-dark">({{$document->getMedia("*")->count() .' '.__('fichiers')}})</span> 
                                    @if ($document->year || $document->month)
                                        @php
                                            $months = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
                                        @endphp
                                        <span class="badge badge-sm badge-success"> <i class="la la-calendar"></i> {{ $document->month ? $months[$document->month-1] : ''}} {{$document->year}} </span>
                                    @endif
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                        <a href="{{ route('admin.documents.index') }}" class="btn btn-warning">
                            <i class="la la-list"></i> {{ __("Documents")}}
                        </a>
                        <span class="dropdown float-md-right">
                            <button id="btnSearchDropdoc" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-dark dropdown-toggle dropdown-menu-right">
                                {{ __("Actions")}}
                            </button>
                            <span aria-labelledby="btnSearchDropdoc" class="dropdown-menu mt-1 dropdown-menu-right">
                                <button class="dropdown-item editData" type="button"  data-toggle="modal" data-target="#editDocumentModal">
                                    <i class="la la-edit"></i> {{ __('Modifier')}}
                                </button>
                                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#docMonthModal" >
                                    <i class="la la-calendar"></i> {{ __('Affecter à un mois')}}
                                </button>
                                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#uploadMediaModal" >
                                    <i class="la la-upload"></i> {{ __('Upload files')}}
                                </button>
                                @if ($document->request)
                                    <a class="dropdown-item" href="{{route('admin.requests.show', $document->request->id)}}"> 
                                        <i class="la la-files-o"></i> {{ __('Consulter demande')}} [{{$document->request->reference}}]
                                    </a>
                                @endif
                                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#emailModal" >
                                    <i class="la la-send"></i> {{ __('Send by email')}}
                                </button>
                                @if ($document->getMedia("*")->count())
                                    <a href="{{ route('admin.documents.download', $document->id) }}" target="_blanc" class="dropdown-item" >
                                        <i class="la la-download"></i> {{ __('Download all files')}}
                                    </a>
                                @endif
                                @if ($users)
                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#permissionModal" >
                                        <i class="la la-key"></i> {{ __('Permissions')}}
                                    </button>
                                @endif
                            </span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="content-body pb-5">
                <section class="mb-5">
                    @if($document->description)
                        <div class="bs-callout-info callout-border-left p-1">
                            <p>{!! $document->description !!}</p>
                        </div>
                    @endif
                    @php
                        $mediaItems = $document->getMedia("*")->sortByDesc('id');
                        $currentIndex = 0;
                    @endphp
                    <div class="row mt-1">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body text-center">
                                        <div class="row">
                                            <div class="col-4 text-left">
                                                <button id="prevBtn" class="btn btn-danger" disabled>
                                                    <i class="la la-arrow-left"></i> {{ __('Précédent') }}
                                                </button>
                                            </div>
                                            <div class="col-4 text-center">
                                                <span id="mediaCounter" class="badge bg-dark badge-lg">
                                                    {{ __('Fichier') }} 1 {{ __('sur') }} {{ $mediaItems->count() }}
                                                </span>
                                            </div>
                                            <div class="col-4 text-right">
                                                <button id="nextBtn" class="btn btn-success">
                                                    {{ __('Suivant') }} <i class="la la-arrow-right"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-12">
                                                @foreach ($mediaItems as $item)
                                                    @php
                                                        if ($item) {
                                                            $file = $item->getUrl();
                                                            $extension = "";
                                                            $mime_type = $item->mime_type;
                                                            switch ($mime_type) {
                                                                case 'application/pdf': $extension = "pdf"; break;
                                                                case 'application/msword': $extension = "word"; break;
                                                                case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document': $extension = "word"; break;
                                                                case 'image/jpeg': $extension = "image"; break;
                                                                case 'image/png': $extension = "image"; break;
                                                            }
                                                            if (in_array($extension, ['pdf', 'word', 'image'])) {
                                                                $extension2 = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                                                foreach ($fileTypes as $type => $extensions) {
                                                                    if (in_array($extension2, $extensions)) {
                                                                        $extension = $type;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    @endphp
                                                    <div class="media-item @if($loop->index != 0) d-none @endif" id="media-item-{{$item->id}}" data-index="{{$loop->index}}">
                                                        <div class="file-item bg-dark text-white " data-id="{{$item->id}}">
                                                            <div class="file-info">
                                                                <div class="file-name">{{ $item->file_name }} [{{ $item->human_readable_size }}]</div>
                                                                <div class="file-size text-white "> <i class="la la-calendar"></i> {{ $item->created_at }}</div>
                                                                @if($item->created_by)
                                                                    @php
                                                                        $user = \App\Models\User::findOrFail($item->created_by);
                                                                    @endphp
                                                                    <div class="file-size text-white"> <i class="la la-user-plus"></i> {{ __('Added by')}}: {{ $user->name }} @if($user->customer_id)<span> ({{ __('Client')}})</span>@endif </div>
                                                                @endif
                                                            </div>
                                                            <div class="file-actions">
                                                                <span class="dropdown actions-datatable float-md-right">
                                                                    <button id="btnSearchDrop{{$item->id}}" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-secondary btn-sm dropdown-toggle dropdown-menu-right">
                                                                        <i class="la la-ellipsis-v"></i>
                                                                    </button>
                                                                    <span aria-labelledby="btnSearchDrop{{$item->id}}" class="dropdown-menu mt-1 dropdown-menu-right">
                                                                        <a href="{{ route('admin.documents.media.download', $item->id) }}" target="_blanc" class="dropdown-item" >
                                                                            <i class="la la-download"></i> {{ __('Download')}}
                                                                        </a>
                                                                        <a href="{{ route('admin.documents.media.delete', $item->id) }}" class="dropdown-item deleteMedia">
                                                                            <i class="la la-trash"></i> {{ __('Delete')}}
                                                                        </a>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="row align-items-center justify-content-center media-details" id="{{'media-'.$item->id}}">
                                                            @if ($file && $extension)
                                                                <div class="col-lg-12">
                                                                    <div class="card-content">
                                                                        <div class="row align-items-center justify-content-center">
                                                                            @include('layout.includes.files.'.$extension, ['fileUrl' => $file])
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="col-lg-12">
                                                                    <div class="card shadow-lg">
                                                                        <div class="card-content collapse show">
                                                                            <div class="card-body">
                                                                                <div class="alert alert-danger mb-2" role="alert">
                                                                                    {{ __("Le fichier ne peut pas etre ouvrir. Télécharger le")}} <a href="{{ route('admin.documents.media.download', $item->id) }}" target="_blanc">{{ __('ici')}}</a> .
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    @include('admin.documents.comment')
    @if ($users)
        @include('admin.documents.permission')
    @endif
    @include('layout.modals.documents.email')
    @include('layout.modals.documents.uploadMedia')
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
                        <input type="hidden" name="id" value="{{$document->id}}">
                        <div class="row mt-5">
                            <div class="col-md-6 form-group">
                                <fieldset>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-year">{{ __('Year')}} </span>
                                        </div>
                                        <select name="year" id="year" class="form-control" aria-describedby="basic-year" >
                                            <option value=""></option>
                                            @for ($i = 2000; $i <= 2050; $i++)
                                                <option value="{{$i}}" {{(($document->year??now()->year) == $i) ? 'selected' : ''}}>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-6 form-group">
                                <fieldset>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-month">{{ __('Month')}} </span>
                                        </div>
                                        <select name="month" id="month" class="form-control" aria-describedby="basic-month" >
                                            <option value=""></option>
                                            @foreach ([['janvier', 1],['février', 2],['mars', 3],['avril', 4],['mai', 5],['juin', 6],['juillet', 7],['août', 8],['septembre', 9],['octobre', 10],['novembre', 11],['décembre', 12]] as $item)
                                                <option value="{{$item[1]}}" {{(($document->month??now()->month) ==$item[1]) ? 'selected' : ''}}>{{$item[0]}}</option>
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
@endsection

@push('scripts')
    <script src="{{ asset('modern-admin/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/editors/summernote/summernote.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({height:250});
            $('.deleteMedia').click(function(e) {
                if(!confirm("{{ __('Êtes-vous sûr de vouloir continuer ?')}}")) {
                    e.preventDefault();
                }
            });
            ajaxForm('#uploadMediaForm');
            ajaxForm('#permissionForm');
            ajaxForm('#editDocumentForm');
            ajaxForm('#docMonthForm');
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#emailForm").submit(function(e) {
                e.preventDefault(); 
                $("body").LoadingOverlay("show");
                var form = $(this);
                var formData = new FormData(this);
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function(resp) {
                        if (resp.error) {
                            $("body").LoadingOverlay("hide", true);
                            toastr.error(resp.error);
                        } else {
                            $('#emailModal').modal('hide');
                            $("body").LoadingOverlay("hide", true);
                            toastr.success(resp.success);
                        }
                    },
                    error: function(xhr) {
                        toastr.error("{{ __('An error has occurred. Please try again.')}}");
                        $("body").LoadingOverlay("hide", true);
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mediaItems = document.querySelectorAll('.media-item');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const mediaCounter = document.getElementById('mediaCounter');
            
            let currentIndex = 0;
            const totalItems = mediaItems.length;
        
            function updateNavigation() {
                // Update buttons state
                prevBtn.disabled = currentIndex === 0;
                nextBtn.disabled = currentIndex === totalItems - 1;
                
                // Update counter
                mediaCounter.textContent = `{{ __('Fichier') }} ${currentIndex + 1} {{ __('sur') }} ${totalItems}`;
                
                // Show/hide media items
                mediaItems.forEach((item, index) => {
                    if (index === currentIndex) {
                        item.classList.remove('d-none');
                    } else {
                        item.classList.add('d-none');
                    }
                });
            }
        
            // Next button event
            nextBtn.addEventListener('click', function() {
                if (currentIndex < totalItems - 1) {
                    currentIndex++;
                    updateNavigation();
                }
            });
        
            // Previous button event
            prevBtn.addEventListener('click', function() {
                if (currentIndex > 0) {
                    currentIndex--;
                    updateNavigation();
                }
            });
        
            // Keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (e.key === 'ArrowLeft') {
                    prevBtn.click();
                } else if (e.key === 'ArrowRight') {
                    nextBtn.click();
                }
            });
        
            // Initialize
            updateNavigation();
        });
    </script>        
@endpush