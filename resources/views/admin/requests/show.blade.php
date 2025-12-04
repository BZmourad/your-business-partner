@extends('layout.app')

@section('title', __('Requests'))
@section('data_col', "2-columns")
@section('body_class', "2-columns")
@section('active_requests', "active")

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/tables/datatable/select.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/tables/extensions/colReorder.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/tables/extensions/fixedHeader.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css/pages/timeline.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/editors/summernote.css') }}">
    <style>
        table.dataTable.no-footer {
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
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('Requests') }}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">{{ __('Details') }}</li>
                                <li class="breadcrumb-item active">{{ $request->reference }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    @include('admin.requests.partials.show.actions')
                </div>
            </div>
            <div class="content-body pb-5">
                @include('admin.requests.partials.show.tabs')
            </div>
        </div>
    </div>
    @include('admin.requests.comment')
    @include('admin.requests.partials.show.modals')
@endsection

@push('scripts')
    <script src="{{ asset('modern-admin/app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/tables/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/tables/datatable/dataTables.colReorder.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/tables/datatable/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/editors/summernote/summernote.js') }}"></script>
    @include('admin.requests.partials.datatable2')
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
            $('#uploadDocumentModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var demandeId = button.data('id');
                var modal = $(this);
                modal.find('#id').val(demandeId);
            });
            $('#setStatusModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var status = button.data('status');
                var modal = $(this);
                modal.find('#status').val(status);
            });
            $('#setPaidStatusModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var status = button.data('status');
                var modal = $(this);
                modal.find('#status').val(status);
            });
            $('#emailModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var document_id = button.data('id');
                var document_name = button.data('name');
                var modal = $(this);
                modal.find('#document_id').val(document_id);
                var html = 'Bonjour, <br>çi joint les documents de: <strong>'+document_name+'</strong>.<br>Cordialement<br>'+'{{ config("app.name") }}';
                modal.find('#summernote').summernote('code', html);
            });
            $('#docMonthModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var demandeId = button.data('id');
                var modal = $(this);
                modal.find('#id').val(demandeId);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({height:250});
        });
    </script>
@endpush