@extends('layout.app')

@section('data_col', 'content-left-sidebar')
@section('body_class', 'content-left-sidebar chat-application')
@section('title', __('Chat'))

@section('active_chat', "active")

@push('styles')
    @if (Auth::user()->lang != 'ar')
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css/pages/app-chat.min.css') }}">
    @else
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css-rtl/pages/app-chat.min.css') }}">
    @endif
@endpush

@section('content')
<div class="app-content content">
    <div class="sidebar-left">
        <div class="sidebar">
            <div class="chat-sidebar card">
                <span class="chat-sidebar-close">
                    <i class="ft-x"></i>
                </span>
                <div class="chat-sidebar-search">
                    <div class="d-flex align-items-center">
                        <fieldset class="form-group position-relative has-icon-left mx-75 mb-0">
                            <input type="text" class="form-control round" id="chat-search" placeholder="{{ __('Search')}}">
                            <div class="form-control-position">
                                <i class="ft-search text-dark"></i>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="chat-sidebar-list-wrapper pt-2">
                    <h6 class="px-2 pb-25 mb-2 cursor-pointer" id="show-users">{{ __('Users')}}<i class="ft-plus float-right"></i></h6>
                    <ul class="chat-sidebar-list mb-2" id="list-users">
                        @foreach($users as $user)
                            <li data-id="{{ $user->id }}" class="user-item bloc-02">
                                <div class="d-flex align-items-center">
                                    <div class="avatar m-0 mr-50 @if(Cache::has('user-is-online-' . $user->id)) avatar-online @else avatar-busy @endif">
                                        <img src="{{ $user->getAvatar() }}" height="36" width="36" alt="sidebar user image" class="shadow-lg">
                                        <i class="avatar-status-away"></i>
                                    </div>
                                    <div class="chat-sidebar-name">
                                        <h6 class="mb-0">
                                            <span class="user-item-name">{{ $user->name }}</span> 
                                            @if($user->unread_messages > 0)
                                                <span class="badge badge-dark">{{ $user->unread_messages }}</span>
                                            @endif
                                        </h6>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <h6 class="px-2 pb-25 mb-2 cursor-pointer" id="show-customers">{{ __('Customers')}}<i class="ft-plus float-right"></i></h6>
                    <ul class="chat-sidebar-list" id="list-customers">
                        @foreach($customers as $user)
                            <li data-id="{{ $user->id }}" class="user-item bloc-02">
                                <div class="d-flex align-items-center">
                                    <div class="avatar m-0 mr-50 @if(Cache::has('user-is-online-' . $user->id)) avatar-online @else avatar-busy @endif">
                                        <img src="{{ $user->getAvatar() }}" height="36" width="36" alt="sidebar user image" class="shadow-lg">
                                        <i class="avatar-status-away"></i>
                                    </div>
                                    <div class="chat-sidebar-name">
                                        <h6 class="mb-0">
                                            <span class="user-item-name">{{ $user->name }}</span> 
                                            @if($user->unread_messages > 0)
                                                <span class="badge badge-dark">{{ $user->unread_messages }}</span>
                                            @endif
                                        </h6>
                                        <span class="text-muted">{{ $user->customer->reference }}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="content-right">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row"></div>
                <div class="chat-overlay"></div>
                <section class="chat-window-wrapper">
                    <div class="chat-start">
                        <span class="ft-message-square chat-sidebar-toggle chat-start-icon font-large-3 p-3 mb-1"></span>
                        <h4 class="d-none d-lg-block py-50 text-bold-500">{{ __("vous n'avez pas actuellement aucun messages ou discution actif !")}}</h4>
                        <button class="btn btn-light-dark chat-start-text chat-sidebar-toggle d-block d-lg-none py-50 px-1">{{ __('Start Conversation!')}}</button>
                    </div>
                    <div class="chat-area d-none">
                        <div class="chat-header">
                            <header class="d-flex justify-content-between align-items-center px-1 py-75">
                                <div class="d-flex align-items-center">
                                    <div class="chat-sidebar-toggle d-block d-lg-none mr-1">
                                        <i class="ft-align-justify font-large-1 cursor-pointer"></i>
                                    </div>
                                    <div class="avatar chat-profile-toggle m-0 mr-1">
                                        <img src="{{ asset('modern-admin/app-assets/images/portrait/small/avatar-s-26.png') }}" id="chat-user-avatar" class="cursor-pointer" alt="avatar" height="36" width="36" />
                                        <span class="avatar-status-busy"></span>
                                    </div>
                                    <h6 class="mb-0" id="chat-user-name"></h6>
                                </div>
                                <div class="chat-header-icons"></div>
                            </header>
                        </div>
                        <div class="card chat-wrapper shadow-none mb-0">
                            <div class="card-content">
                                <div class="card-body chat-container">
                                    <div class="chat-content" id="messages-list"></div>
                                </div>
                            </div>
                            <div class="card-footer chat-footer px-2 py-1 pb-0">
                                <form class="d-flex align-items-center" action="javascript:void(0);" id="message-form">
                                    <input type="hidden" id="receiver_id">
                                    <input type="file" id="attachment" class="d-none">
                                    <i class="ft-paperclip ml-1 cursor-pointer" id="attach-btn"></i>
                                    <input type="text" class="form-control chat-message-send mx-1" id="message" placeholder="{{ __('Type your message here...')}}">
                                    <button type="submit" class="btn btn-primary glow send d-lg-flex"><i class="ft-play"></i>
                                        <span class="d-none d-lg-block mx-50">{{ __('Send')}}</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="chat-profile"></section>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('modern-admin/app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/charts/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/js/scripts/ui/breadcrumbs-with-stats.min.js') }}"></script>
    @include('admin.messages.script-chat')
    @include('admin.messages.script')
@endpush
