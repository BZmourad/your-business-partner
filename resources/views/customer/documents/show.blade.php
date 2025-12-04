@extends('layout.app')

@section('title', __('Documents'))
@section('data_col', "2-columns")
@section('body_class', "2-columns")
@section('active_documents', "active")

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/editors/summernote.css') }}">
@endpush

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('Documents') }}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">{{ __('Details') }}</li>
                                <li class="breadcrumb-item active">{{ $document->reference }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                        <a href="{{ route('customer.documents.index') }}" class="btn btn-warning">
                            <i class="la la-list"></i>
                        </a>
                        <span class="dropdown actions-datatable float-md-right">
                            <button id="btnSearchDropdoc" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-dark dropdown-toggle dropdown-menu-right">
                                <i class="la la-ellipsis-v"></i>
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
                                    <a class="dropdown-item" href="{{route('customer.requests.show', $document->request->id)}}"> 
                                        <i class="la la-files-o"></i> {{ __('Consulter demande')}} [{{$document->request->reference}}]
                                    </a>
                                @endif
                                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#emailModal" >
                                    <i class="la la-send"></i> {{ __('Send by email')}}
                                </button>
                                @if ($document->getMedia("*")->count())
                                    <a href="{{ route('customer.documents.download', $document->id) }}" target="_blanc" class="dropdown-item" >
                                        <i class="la la-download"></i> {{ __('Download all files')}}
                                    </a>
                                @endif
                            </span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="content-body pb-5">
                <section class="mb-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-light text-center">
                                    <h4 class="text-center">{{$document->name}} <span class="text-dark">({{$document->getMedia("*")->count() .' '.__('fichiers')}})</span> </h4>
                                    @if($document->description)<p class="text-center">{!! $document->description !!}</p>@endif
                                    @if ($document->year || $document->month)
                                        @php
                                            $months = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
                                        @endphp
                                        <span class="badge badge-sm badge-success"> <i class="la la-calendar"></i> {{ $document->month ? $months[$document->month-1] : ''}} {{$document->year}} </span>
                                    @endif
                                </div>
                                <div class="card-content">
                                    <div class="card-body text-center">
                                        <div class="row">
                                            @foreach ($document->getMedia("*")->sortByDesc('id') as $item)
                                                <div class="col-12" id="media-item-{{$item->id}}">
                                                    <div class="file-item showFile @if($loop->index == 0) bg-dark text-white @endif" data-id="{{$item->id}}" style="cursor: pointer;">
                                                        <div class="file-info">
                                                            <div class="file-name">{{ $item->file_name }} [{{ $item->human_readable_size }}]</div>
                                                            <div class="file-size @if($loop->index == 0) text-white @endif"> <i class="la la-calendar"></i> {{ $item->created_at }}</div>
                                                            @if($item->created_by)
                                                                @php
                                                                    $user = \App\Models\User::findOrFail($item->created_by);
                                                                @endphp
                                                                <div class="file-size @if($loop->index == 0) text-white @endif"> <i class="la la-user-plus"></i> {{ __('Added by')}}: {{ $user->name }} @if($user->customer_id)<span> ({{ __('Client')}})</span>@endif </div>
                                                            @endif
                                                        </div>
                                                        <div class="file-actions">
                                                            <span class="dropdown actions-datatable float-md-right">
                                                                <button id="btnSearchDrop{{$item->id}}" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-secondary btn-sm dropdown-toggle dropdown-menu-right">
                                                                    <i class="la la-ellipsis-v"></i>
                                                                </button>
                                                                <span aria-labelledby="btnSearchDrop{{$item->id}}" class="dropdown-menu mt-1 dropdown-menu-right">
                                                                    <a href="{{ route('customer.documents.media.download', $item->id) }}" target="_blanc" class="dropdown-item" >
                                                                        <i class="la la-download"></i> {{ __('Download')}}
                                                                    </a>
                                                                    <a href="{{ route('customer.documents.media.delete', $item->id) }}" class="dropdown-item deleteMedia">
                                                                        <i class="la la-trash"></i> {{ __('Delete')}}
                                                                    </a>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            @php
                                $fileTypes = [
                                    'pdf' => ['pdf'],
                                    'word' => ['doc', 'docx'],
                                    'image' => ['jpg', 'jpeg', 'png'],
                                ]; 
                            @endphp
                            @foreach ($document->getMedia("*")->sortByDesc('id') as $media)
                                @php
                                    if ($media) {
                                        $file = $media->getUrl();
                                        $extension = "";
                                        $mime_type = $media->mime_type;
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
                                <div class="row align-items-center justify-content-center media-details  @if($loop->index != 0) d-none @endif" id="{{'media-'.$media->id}}">
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
                                            <div class="card">
                                                <div class="card-content collapse show">
                                                    <div class="card-body">
                                                        <div class="alert alert-danger mb-2" role="alert">
                                                            {{ __("Le fichier ne peut pas etre ouvrir. Télécharger le")}} <a href="{{ route('customer.documents.media.download', $item->id) }}" target="_blanc">{{ __('ici')}}</a> .
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    @include('customer.documents.comment')
    @include('layout.modals.documents.email')
    @include('layout.modals.documents.uploadMedia')
    @include('layout.modals.documents.editDocument')
@endsection

@push('scripts')
    <script src="{{ asset('modern-admin/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/editors/summernote/summernote.js') }}"></script>
    <script>
        $(document).ready(function() {
            var data_id;
            $('body').on('click', '.showFile', function () {
                data_id = $(this).data("id");
                $('.media-details').addClass('d-none');
                $('#media-'+data_id).removeClass('d-none');
                $('.showFile').removeClass('bg-dark text-white');
                $('.showFile .file-size').removeClass('text-white');
                $(this).addClass('bg-dark text-white');
                $(this).find('.file-size').addClass('text-white');
            });
            $('#summernote').summernote({height:250});
            $('.deleteMedia').click(function(e) {
                if(!confirm("{{ __('Êtes-vous sûr de vouloir continuer ?')}}")) {
                    e.preventDefault();
                }
            });
            ajaxForm('#uploadMediaForm');
            ajaxForm('#permissionForm');
            ajaxForm('#editDocumentForm');
        });
    </script>
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
@endpush