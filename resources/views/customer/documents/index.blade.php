@extends('layout.app')

@section('title', __('Documents'))
@section('data_col', "2-columns")
@section('body_class', "2-columns")
@section('active_documents', "active")

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/tables/datatable/select.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/tables/extensions/colReorder.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/tables/extensions/fixedHeader.dataTables.min.css') }}">
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
                <h3 class="content-header-title mb-0 d-inline-block">{{ __('Documents') }}</h3>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right">
                    <button class="btn btn-success" data-toggle="modal" data-target="#addDocumentModal"> <i class="fa fa-plus"></i> </button>
                    <button class="btn btn-secondary" data-toggle="modal" data-target="#filterModal"> <i class="la la-filter"></i> </button>
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
                                                <th>{{ __('ID')}}</th>
                                                <th>{{ __('Request') }}</th>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Month') }}</th>
                                                <th>{{ __('Crée Le')}}</th>
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
                        <label for="requestId">{{ __('Request') }}</label>
                        <select class="form-control select2" id="requestId" name="requestId">
                            <option value="">{{ __('All') }}</option>
                            @foreach ($requests as $item)
                                <option value="{{$item->id}}">{{ $item->reference }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 form-group">
                        <fieldset>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-year-2">{{ __('Year')}}</span>
                                </div>
                                <select name="year" id="year2" class="form-control" aria-describedby="basic-year-2">
                                    <option value=""></option>
                                    @for ($i = 2000; $i <= 2050; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-12 form-group">
                        <fieldset>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-month-2">{{ __('Month')}}</span>
                                </div>
                                <select name="month" id="month2" class="form-control" aria-describedby="basic-month-2">
                                    <option value=""></option>
                                    @foreach ([['janvier', 1],['février', 2],['mars', 3],['avril', 4],['mai', 5],['juin', 6],['juillet', 7],['août', 8],['septembre', 9],['octobre', 10],['novembre', 11],['décembre', 12]] as $item)
                                        <option value="{{$item[1]}}">{{$item[0]}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.modals.documents.addDocument')
@include('layout.modals.documents.editDocument')
@endsection

@push('scripts')
    <script src="{{ asset('modern-admin/app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/tables/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/tables/datatable/dataTables.colReorder.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/tables/datatable/dataTables.fixedHeader.min.js') }}"></script>
    @include('customer.documents.partials.datatable')
    <script>
        $(document).ready(function() {
            $(".skin-square input").iCheck({
                checkboxClass: "icheckbox_square-green",
                radioClass: "iradio_square-green"
            });
        });
    </script>
@endpush