@extends('layout.app')

@section('title', __('Roles'))
@section('data_col', "2-columns")
@section('body_class', "2-columns")
@section('active_roles', "active")

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('Roles') }}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">{{ isset($role) ? __('Edit') : __('Add') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-warning">
                            <i class="la la-list"></i> {{ __("Roles")}}
                        </a>
                        <button type="submit" form="roleForm" class="btn btn-success">
                            <i class="fas fa-check"></i> {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </div>
            <div class="content-body pb-5">
                <form id="roleForm" method="POST" action="{{ isset($role) ? route('admin.roles.update', $role->id) : route('admin.roles.store') }}">
                    @csrf
                    @if(isset($role))
                        @method('PUT')
                    @endif
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">{{ __('Role Name') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $role->name ?? '') }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-content">
                            <div class="card-header">
                                <h4 class="mb-0">
                                    {{ __('Permissions') }}
                                </h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <div class="row skin skin-square">
                                        <div class="col-md-12">
                                            <fieldset>
                                                <input type="checkbox" id="select_all" name="select_all" value="1">
                                                <label for="select_all">{{ __('Select all')}}</label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($permission as $value)
                                        <div class="col-sm-4 skin skin-square">
                                            <fieldset>
                                                <input type="checkbox" id="permission-{{$value->id}}" name="permission[]" value="{{$value->id}}" {{isset($role) && in_array($value->id, $rolePermissions) ? 'checked' : ''}} class="permission-checkbox">
                                                <label for="permission-{{$value->id}}"> <i class="{{$value->icon}}"></i> {{ __($value->description) }}</label>
                                            </fieldset>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-content">
                            <div class="card-header">
                                <h4 class="mb-0">
                                    {{ __('Services Permissions') }}
                                </h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <div class="row skin skin-square">
                                        <div class="col-md-12">
                                            <fieldset>
                                                <input type="checkbox" id="select_all_2" name="select_all_2" value="1">
                                                <label for="select_all_2">{{ __('Select all')}}</label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($permissionService as $value)
                                        <div class="col-sm-4 skin skin-square">
                                            <fieldset>
                                                <input type="checkbox" id="permission-{{$value->id}}" name="permission[]" value="{{$value->id}}" class="permission-services permission-checkbox-2" {{isset($role) && in_array($value->id, $rolePermissions) ? 'checked' : ''}}>
                                                <label for="permission-{{$value->id}}">{{ __($value->description) }}</label>
                                            </fieldset>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            ajaxForm('#roleForm');
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".skin-square input").iCheck({
                checkboxClass: "icheckbox_square-green",
                radioClass: "iradio_square-green"
            });
            
            // Select all for first section
            $('#select_all').on('ifChanged', function(event) {
                var isChecked = $(this).is(':checked');
                $('.permission-checkbox').iCheck(isChecked ? 'check' : 'uncheck');
            });
            
            // Select all for second section
            $('#select_all_2').on('ifChanged', function(event) {
                var isChecked = $(this).is(':checked');
                $('.permission-checkbox-2').iCheck(isChecked ? 'check' : 'uncheck');
            });
        });
    </script>
@endpush