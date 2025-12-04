<div class="row">
    <div class="col-12">
        <div class="customer-detail-card card">
            <div class="customer-detail-header">
                <span class="text-truncate">
                    <span class="avatar avatar-xs">
                        <a href="{{ $user->getAvatar() }}" data-fancybox>
                            <img class="box-shadow-2" src="{{ $user->getAvatar() }}" alt="avatar">
                        </a>
                    </span>
                    <span>
                        {{ $user->name }}
                        @if ($user->is_active)
                            <span class="badge badge-success"><i class="la la-check-circle"></i> {{ __('Active') }}</span>
                        @else
                            <span class="badge badge-danger"> <i class="la la-times-circle"></i> {{ __('Inactive') }}</span>
                        @endif
                    </span>
                </span>
            </div>
            <div class="customer-detail-body">
                <h5 class="section-title"><i class="fas fa-info-circle mr-1"></i> {{ __('Personal Information') }}</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('Email') }}</div>
                            <div class="detail-value">{{ $user->email }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('Job Title') }}</div>
                            <div class="detail-value">{{ $user->job_title ?? '------------------' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('Phone') }}</div>
                            <div class="detail-value">{{ $user->phone ?? '------------------' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('Fax') }}</div>
                            <div class="detail-value">{{ $user->fax ?? '------------------' }}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('Gender') }}</div>
                            <div class="detail-value">
                                @if($user->gender == 'homme')
                                    {{ __('Homme') }}
                                @elseif($user->gender == 'femme')
                                    {{ __('Femme') }}
                                @else
                                    {{ '------------------' }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('Birth Date') }}</div>
                            <div class="detail-value">{{ $user->birth_date ? $user->birth_date : '------------------' }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('Marital Status') }}</div>
                            <div class="detail-value">
                                @switch($user->marital_status)
                                    @case('single') {{ __('Single') }} @break
                                    @case('married') {{ __('Married') }} @break
                                    @case('divorced') {{ __('Divorced') }} @break
                                    @case('widowed') {{ __('Widowed') }} @break
                                    @default {{ '------------------' }}
                                @endswitch
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('Country') }}</div>
                            <div class="detail-value">
                                {!! $user->country ? '<img  class="img-flag" style="width: 20px; height: 15px; margin-right: 5px;" src="'.asset('img/flags/' . strtolower($user->country) . '.svg').'"> '.country($user->country) : '------------------' !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('Nationality') }}</div>
                            <div class="detail-value">
                                {!! $user->nationality ? '<img  class="img-flag" style="width: 20px; height: 15px; margin-right: 5px;" src="'.asset('img/flags/' . strtolower($user->nationality) . '.svg').'"> '.nationality($user->nationality) : '------------------' !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('Birth Place') }}</div>
                            <div class="detail-value">{{ $user->birth_place ?? '------------------' }}</div>
                        </div>
                    </div>
                </div>
                <div class="detail-group">
                    <div class="detail-label">{{ __('Address') }}</div>
                    <div class="detail-value">{!! $user->address ?? '------------------' !!}</div>
                </div>
                <h5 class="section-title mt-4"><i class="fas fa-id-card mr-1"></i> {{ __('Identity Information') }}</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('ID Type') }}</div>
                            <div class="detail-value">
                                @switch($user->id_type)
                                    @case('cin') {{ __('CIN') }} @break
                                    @case('passport') {{ __('Passport') }} @break
                                    @case('other') {{ __($user->id_type_other) }} @break
                                    @default {{ '------------------' }}
                                @endswitch
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('ID Number') }}</div>
                            <div class="detail-value">{{ $user->id_number ?? '------------------' }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('ID Issue Place') }}</div>
                            <div class="detail-value">{{ $user->id_issue_place ?? '------------------' }}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('ID Issue Date') }}</div>
                            <div class="detail-value">{{ $user->id_issue_date ? $user->id_issue_date : '------------------' }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('ID Expiry Date') }}</div>
                            <div class="detail-value">{{ $user->id_expiry_date ? $user->id_expiry_date : '------------------' }}</div>
                        </div>
                    </div>
                </div>
                <h5 class="section-title mt-4"><i class="la la-key mr-1"></i> {{ __('Permissions') }}</h5>
                <div class="row">
                    @foreach ($user->getPermissionsViaRoles()->whereNull('service_id') as $p)
                        <span class="badge badge-primary badge-md badge-glow m-1"> <i class="{{$p->icon}}"></i> {{ __($p->description)}} </span>
                    @endforeach
                </div>
                <h5 class="section-title mt-4"><i class="fas fa-key mr-1"></i> {{ __('Service Permissions') }}</h5>
                <div class="row">
                    @foreach ($user->getPermissionsViaRoles()->whereNotNull('service_id')->pluck('description') as $item)
                        <span class="badge badge-warning badge-md badge-glow m-1"> {{ __($item)}} </span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <style>
        .customer-detail-card {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .customer-detail-header {
            background-color: #f8f9fa;
            padding: 15px 20px;
            border-bottom: 1px solid #e9ecef;
            font-weight: 600;
            font-size: 1.1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .customer-detail-body {
            padding: 20px;
        }
        .detail-group {
            margin-bottom: 15px;
            padding: 5px;
            border: 1px grey dashed;
        }
        .detail-label {
            font-weight: 600;
            color: black;
            font-size: 0.85rem;
            margin-bottom: 5px;
        }
        .detail-value {
            font-size: 1rem;
            color: #495057;
        }
        .section-title {
            border-bottom: 2px solid #002960;
            padding-bottom: 8px;
            margin-bottom: 20px;
            color: #002960;
            font-weight: 600;
        }
        .badge-particulier {
            background-color: #002960;
            color: white;
        }
        .badge-entreprise {
            background-color: #28a745;
            color: white;
        }
    </style>
@endpush