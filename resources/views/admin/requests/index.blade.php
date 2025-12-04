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
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('Requests') }}</h3>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                        @if (auth()->user()->hasServices())
                            <a href="{{ route('admin.requests.choose.services') }}" class="btn btn-success">
                                <i class="fa fa-plus"></i> {{ __('Add')}}
                            </a>
                        @endif
                        <button class="btn btn-secondary" data-toggle="modal" data-target="#filterModal"> <i class="la la-filter"></i> {{ __('Filter')}} </button>
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
                                                    <th>{{ __('Service') }}</th>
                                                    <th>{{ __('Customer') }}</th>
                                                    <th>{{ __('Status') }}</th>
                                                    <th>{{ __('Paid Status') }}</th>
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
                            <label for="status">{{ __('Status') }}</label>
                            <select class="form-control" id="status" name="status">
                                <option value="">{{ __('All') }}</option>
                                <option value="pending">{{ __('En attente') }}</option>
                                <option value="in_progress">{{ __('En cours') }}</option>
                                <option value="completed">{{ __('Terminée') }}</option>
                                <option value="refused">{{ __('refusé') }}</option>
                            </select>
                        </div>
                        <div class="col-12 form-group">
                            <label for="paid_status">{{ __('Paid Status') }}</label>
                            <select class="form-control" id="paid_status" name="paid_status">
                                <option value="">{{ __('All') }}</option>
                                <option value="unpaid">{{ __('Unpaid') }}</option>
                                <option value="paid">{{ __('Paid') }}</option>
                            </select>
                        </div>
                        <div class="col-12 form-group mt-1">
                            <label for="customer_id">{{ __('Customer') }}</label>
                            <select class="form-control select2" id="customer_id" name="customer_id">
                                <option value="">{{ __('All') }}</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->reference}}| {{ $customer->last_name .' '. $customer->first_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 form-group mt-1">
                            <label for="service_id">{{ __('Service') }}</label>
                            <select class="form-control select2" id="service_id" name="service_id">
                                <option value="">{{ __('All') }}</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->reference}}| {{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal animated bounceInUp text-left" id="setStatusModal" tabindex="-1" role="dialog" aria-labelledby="setStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-2 pb-3">
                    <form id="setStatusForm" method="POST" action="{{ route('admin.requests.setStatusJSON') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="status" id="status">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="notes">{{ __('Note') }}</label>
                                <textarea name="notes" id="notes" class="form-control" rows="8"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <button type="submit" form="setStatusForm" class="btn btn-success btn-block">
                                <i class="fas fa-check"></i> {{ __('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal animated bounceInUp text-left" id="setPaidStatusModal" tabindex="-1" role="dialog" aria-labelledby="setPaidStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-2 pb-3">
                    <form id="setPaidStatusForm" method="POST" action="{{ route('admin.requests.setPaidStatusJSON') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="status" id="status">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="notes">{{ __('Note') }}</label>
                                <textarea name="notes" id="notes" class="form-control" rows="8"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <button type="submit" form="setPaidStatusForm" class="btn btn-success btn-block">
                                <i class="fas fa-check"></i> {{ __('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('modern-admin/app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/tables/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/tables/datatable/dataTables.colReorder.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/tables/datatable/dataTables.fixedHeader.min.js') }}"></script>
    @include('admin.requests.partials.datatable')
    <script>
        $(document).ready(function() {
            $('#setStatusModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var requestId = button.data('id');
                var status = button.data('status');
                var modal = $(this);
                modal.find('#id').val(requestId);
                modal.find('#status').val(status);
            });
            $('#setPaidStatusModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var requestId = button.data('id');
                var status = button.data('status');
                var modal = $(this);
                modal.find('#id').val(requestId);
                modal.find('#status').val(status);
            });
        });
    </script>
@endpush