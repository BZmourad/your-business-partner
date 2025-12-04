@extends('layout.app')

@section('title', __('Users'))
@section('data_col', "2-columns")
@section('body_class', "2-columns")
@section('active_users', "active")

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">{{ __('Users') }}</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">{{ __('Details') }}</li>
                            <li class="breadcrumb-item active">{{ $user->name }}</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-warning">
                        <i class="la la-list"></i> {{ __("Users")}}
                    </a>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-blue">
                        <i class="fas fa-edit"></i> {{ __("Edit")}}
                    </a>
                </div>
            </div>
        </div>
        <div class="content-body pb-5">
            <section>
                @include('admin.users.fiche')
                {{--<div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $user->name }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Permissions:</strong>
                            @if(!empty($userPermissions))
                                @foreach($userPermissions as $v)
                                    <label class="label label-success">{{ $v->name }},</label>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>--}}
            </section>
        </div>
    </div>
</div>
@endsection
