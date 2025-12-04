@extends('errors.minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message')
{{ __('You do not have permission to access for this page.')}} {{ __('Only')}} {{Session::get('type') }} {{ __('can access to this page.')}}
@endsection
