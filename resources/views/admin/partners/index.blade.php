@extends('layout.app')

@section('title', __('Partners'))
@section('data_col', "2-columns")
@section('body_class', "2-columns")
@section('active_partners', "active")

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
                <h3 class="content-header-title mb-0 d-inline-block">{{ __('Partners') }}</h3>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right">
                    <a href="{{ route('admin.partners.create') }}" class="btn btn-success">
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
                                                <th> {{ __('Crée Le')}} </th>
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
                        <label for="partner_type">{{ __('Type de partner') }}</label>
                        <select class="form-control" id="partner_type" name="partner_type">
                            <option value="">{{ __('All') }}</option>
                            <option value="particulier">{{ __('Particulier') }}</option>
                            <option value="entreprise">{{ __('Entreprise') }}</option>
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
    @include('admin.partners.partials.datatable')
@endpush