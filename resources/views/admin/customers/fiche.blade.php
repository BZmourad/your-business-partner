<div class="row">
    <div class="col-12">
        <div class="customer-detail-card card">
            <div class="customer-detail-header">
                <span class="text-truncate">
                    @if ($customer->user)
                        <span class="avatar avatar-xs">
                            <a href="{{ $customer->user->getAvatar() }}" data-fancybox>
                                <img class="box-shadow-2" src="{{ $customer->user->getAvatar() }}" alt="avatar">
                            </a>
                        </span>
                    @endif
                    <span>
                        {{ $customer->reference }}|{{ $customer->first_name }} {{ $customer->last_name }}
                        @if ($customer->user)
                            <span class="badge badge-success">{{ __('Has account') }}</span>
                            @if (!$customer->user->is_active)<span class="badge badge-danger">{{ __('Compte désactivé') }}</span>@endif
                        @endif
                    </span>
                </span>
                <span class="badge badge-{{ $customer->customer_type }}">{{ ucfirst($customer->customer_type) }}</span>
            </div>
            <div class="customer-detail-body">
                <h5 class="section-title"><i class="fas fa-info-circle mr-1"></i> {{ __('Personal Information') }}</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('Email') }}</div>
                            <div class="detail-value">{{ $customer->email }}</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('Phone') }}</div>
                            <div class="detail-value">{{ $customer->phone ?? '------------------' }}</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('Fax') }}</div>
                            <div class="detail-value">{{ $customer->fax ?? '------------------' }}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('Gender') }}</div>
                            <div class="detail-value">
                                @if($customer->gender == 'homme')
                                    {{ __('Homme') }}
                                @elseif($customer->gender == 'femme')
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
                            <div class="detail-value">{{ $customer->birth_date ? $customer->birth_date : '------------------' }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('Marital Status') }}</div>
                            <div class="detail-value">
                                @switch($customer->marital_status)
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
                                {!! $customer->country ? '<img  class="img-flag" style="width: 20px; height: 15px; margin-right: 5px;" src="'.asset('img/flags/' . strtolower($customer->country) . '.svg').'"> '.country($customer->country) : '------------------' !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('Nationality') }}</div>
                            <div class="detail-value">
                                {!! $customer->nationality ? '<img  class="img-flag" style="width: 20px; height: 15px; margin-right: 5px;" src="'.asset('img/flags/' . strtolower($customer->nationality) . '.svg').'"> '.nationality($customer->nationality) : '------------------' !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('Birth Place') }}</div>
                            <div class="detail-value">{{ $customer->birth_place ?? '------------------' }}</div>
                        </div>
                    </div>
                </div>
                <div class="detail-group">
                    <div class="detail-label">{{ __('Address') }}</div>
                    <div class="detail-value">{!! $customer->address ?? '------------------' !!}</div>
                </div>
                <h5 class="section-title mt-4"><i class="fas fa-id-card mr-1"></i> {{ __('Identity Information') }}</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('ID Type') }}</div>
                            <div class="detail-value">
                                @switch($customer->id_type)
                                    @case('cin') {{ __('CIN') }} @break
                                    @case('passport') {{ __('Passport') }} @break
                                    @case('other') {{ __($customer->id_type_other) }} @break
                                    @default {{ '------------------' }}
                                @endswitch
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('ID Number') }}</div>
                            <div class="detail-value">{{ $customer->id_number ?? '------------------' }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('ID Issue Place') }}</div>
                            <div class="detail-value">{{ $customer->id_issue_place ?? '------------------' }}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('ID Issue Date') }}</div>
                            <div class="detail-value">{{ $customer->id_issue_date ? $customer->id_issue_date : '------------------' }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('ID Expiry Date') }}</div>
                            <div class="detail-value">{{ $customer->id_expiry_date ? $customer->id_expiry_date : '------------------' }}</div>
                        </div>
                    </div>
                </div>
                @if ($customer->contacts->count() > 0)
                    <h5 class="section-title mt-4"><i class="fas fa-users mr-1"></i> {{ __('Contacts Information') }}</h5>
                    <div class="row">
                        @foreach ($customer->contacts as $contact)
                            <div class="col-md-4">
                                <div class="detail-group">
                                    @if($contact->name)<div class="detail-value"> <i class="la la-user"></i> {{$contact->name}} </div>@endif
                                    @if($contact->email)<div class="detail-value"> <i class="la la-envelope"></i> {{$contact->email}} </div>@endif
                                    @if($contact->phone1)<div class="detail-value"> <i class="la la-phone"></i> {{$contact->phone1}} </div>@endif
                                    @if($contact->phone2)<div class="detail-value"> <i class="la la-phone"></i> {{$contact->phone2}} </div>@endif
                                    @if($contact->whatsapp)<div class="detail-value"> <i class="la la-whatsapp"></i> {{$contact->whatsapp}} </div>@endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                <h5 class="section-title mt-4"><i class="fas fa-briefcase mr-1"></i> {{ __('Professional Information') }}</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('Profession') }}</div>
                            <div class="detail-value">{{ $customer->profession ?? '------------------' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('Job Title') }}</div>
                            <div class="detail-value">{{ $customer->job_title ?? '------------------' }}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('Employer') }}</div>
                            <div class="detail-value">{{ $customer->employer ?? '------------------' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('Work Phone') }}</div>
                            <div class="detail-value">{{ $customer->work_phone ?? '------------------' }}</div>
                        </div>
                    </div>
                </div>
                <div class="detail-group">
                    <div class="detail-label">{{ __('Work Address') }}</div>
                    <div class="detail-value">{{ $customer->work_address ?? '------------------' }}</div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('Activity') }}</div>
                            <div class="detail-value">{{ $customer->activity ?? '------------------' }}</div>
                        </div>
                    </div>
                </div>
                <h5 class="section-title mt-4"><i class="fas fa-chart-line mr-1"></i> {{ __('Tax Information') }}</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('Tax ID') }}</div>
                            <div class="detail-value">{{ $customer->tax_id ?? '------------------' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('Tax Regime') }}</div>
                            <div class="detail-value">{{ $customer->tax_regime ?? '------------------' }}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('Commerce Register Number') }}</div>
                            <div class="detail-value">{{ $customer->commerce_register_number ?? '------------------' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-group">
                            <div class="detail-label">{{ __('Business Sector') }}</div>
                            <div class="detail-value">{{ $customer->business_sector ?? '------------------' }}</div>
                        </div>
                    </div>
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