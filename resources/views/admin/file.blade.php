@extends('layout.app')

@section('title', __('Files'))
@section('data_col', "2-columns")
@section('body_class', "2-columns")

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body pb-5">
                <section id="page-account-settings">
                    <div class="container">
                        <div class="row">
                            @include('layout.includes.files.'.$extension, ['fileUrl' => $file])
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
