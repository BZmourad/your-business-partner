<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche Client - {{ $customer->first_name }} {{ $customer->last_name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            background: #fff;
        }

        /* En-tête du document */
        .document-header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #002960;
        }

        .document-title {
            font-size: 24px;
            font-weight: bold;
            color: #002960;
            margin-bottom: 5px;
        }

        .document-subtitle {
            font-size: 16px;
            color: #666;
        }

        /* Carte principale */
        .customer-detail-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            background: #fff;
        }

        /* En-tête de la carte */
        .customer-detail-header {
            background-color: #002960;
            color: white;
            padding: 15px 20px;
            border-radius: 8px 8px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .customer-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid white;
        }

        .customer-name {
            font-size: 18px;
            font-weight: bold;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
        }

        .badge-success {
            background-color: #28a745;
            color: white;
        }

        .badge-danger {
            background-color: #dc3545;
            color: white;
        }

        .badge-particulier {
            background-color: #002960;
            color: white;
        }

        .badge-entreprise {
            background-color: #28a745;
            color: white;
        }

        /* Corps de la carte */
        .customer-detail-body {
            padding: 20px;
        }

        /* Sections */
        .section-title {
            color: #002960;
            font-size: 16px;
            font-weight: bold;
            border-bottom: 2px solid #002960;
            padding-bottom: 8px;
            margin: 25px 0 15px 0;
            page-break-after: avoid;
        }

        .section-title:first-child {
            margin-top: 0;
        }

        /* Grille et détails */
        .row {
            /*display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;*/
            display: table;
            width: 100%;
        }

        .col-md-3, .col-md-4, .col-md-6 {
            padding: 0 10px;
            /*flex: 1 0 auto;*/
        }

        .col-md-4 {
            display: table-cell;
            vertical-align: top;
            width: 33.333%;
        }

        .col-md-6 {
            display: table-cell;
            vertical-align: top;
            width: 50%;
        }

        .col-md-3 {
            display: table-cell;
            vertical-align: top;
            width: 25%;
        }

        .detail-group {
            margin-bottom: 12px;
            padding: 8px;
            border: 1px dashed #ccc;
            border-radius: 4px;
            background: #f9f9f9;
            page-break-inside: avoid;
        }

        .detail-label {
            font-weight: bold;
            color: #002960;
            font-size: 10px;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .detail-value {
            font-size: 11px;
            color: #333;
        }

        /* Images des drapeaux */
        .img-flag {
            width: 16px !important;
            height: 12px !important;
            margin-right: 5px;
            vertical-align: middle;
        }

        /* Informations système */
        .system-info {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 15px;
            margin-top: 20px;
        }

        /* Pied de page */
        .document-footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #ddd;
            font-size: 10px;
            color: #666;
        }

        /* Gestion des sauts de page */
        .page-break {
            page-break-before: always;
        }

        .avoid-break {
            page-break-inside: avoid;
        }

        /* Utilitaires */
        .text-center {
            text-align: center;
        }

        .mt-4 {
            margin-top: 25px;
        }

        .mb-3 {
            margin-bottom: 15px;
        }

        /* Styles d'impression */
        @media print {
            body {
                font-size: 11px;
            }
            
            .customer-detail-card {
                border: 1px solid #000;
            }
            
            .detail-group {
                border: 1px dashed #999;
            }
            
            .section-title {
                color: #000;
                border-bottom-color: #000;
            }
        }
    </style>
</head>
<body>
    <div class="document-header">
        <div class="document-title">FICHE CLIENT</div>
        <div class="document-subtitle">{{ config('app.name') }}</div>
    </div>
    <div class="customer-detail-card">
        <div class="customer-detail-header">
            <div class="customer-info">
                @if($customer->user)
                    <img class="avatar" src="{{ $customer->user->getAvatar() }}" alt="Avatar">
                @endif
                <span class="customer-name">
                    {{ $customer->first_name }} {{ $customer->last_name }}
                    <span class="badge badge-success">{{ ucfirst($customer->customer_type) }}</span>
                </span>
            </div>
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
                            @if($customer->country)
                                <img class="img-flag" src="{{ asset('img/flags/' . strtolower($customer->country) . '.svg') }}" alt="{{ $customer->country }}">
                                {{ country($customer->country) }}
                            @else
                                {{ '------------------' }}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="detail-group">
                        <div class="detail-label">{{ __('Nationality') }}</div>
                        <div class="detail-value">
                            @if($customer->nationality)
                                <img class="img-flag" src="{{ asset('img/flags/' . strtolower($customer->nationality) . '.svg') }}" alt="{{ $customer->nationality }}">
                                {{ nationality($customer->nationality) }}
                            @else
                                {{ '------------------' }}
                            @endif
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
                <div class="detail-value">{!! nl2br(e($customer->address ?? '------------------')) !!}</div>
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
                                @if($contact->name)<div class="detail-value"> {{ __('Name')}}: {{$contact->name}} </div>@endif
                                @if($contact->email)<div class="detail-value"> {{ __('Email')}}: {{$contact->email}} </div>@endif
                                @if($contact->phone1 || $contact->phone2)<div class="detail-value"> {{ __('Phone')}}: {{$contact->phone1}}  {{($contact->phone1 && $contact->phone2) ? '|' : ''}} {{$contact->phone2}}</div>@endif
                                @if($contact->whatsapp)<div class="detail-value"> {{ __('Whatsapp')}}: {{$contact->whatsapp}} </div>@endif
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
            <div class="detail-group">
                <div class="detail-label">{{ __('Activity') }}</div>
                <div class="detail-value">{{ $customer->activity ?? '------------------' }}</div>
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
    <div class="document-footer">
        Document généré le {{ now()->format('d/m/Y à H:i') }} - {{ config('app.name') }}
    </div>
</body>
</html>