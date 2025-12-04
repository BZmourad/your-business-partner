<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Devis {{ $devis['numero'] }} - {{ config('company.name') }}</title>
    <style>
        /* Reset et base */
        body { 
            font-family: Verdana, sans-serif; 
            font-size: 12px; 
            line-height: 1.6;
            color: #333333;
            margin: 0;
            padding: 0;
            background: white;
        }

        div { 
            font-family: Verdana, sans-serif; $
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
            padding: 20px;
        }

        /* En-tête - Design simplifié */
        .header {
            display: table;
            width: 100%;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 3px solid #002960;
        }

        .logo-section {
            display: table-cell;
            vertical-align: top;
            width: 30%;
        }

        .logo {
            max-width: 150px;
            max-height: 70px;
            margin-bottom: 10px;
        }

        .entreprise-info {
            display: table-cell;
            vertical-align: top;
            width: 40%;
            padding: 0 20px;
        }

        .devis-info {
            display: table-cell;
            vertical-align: top;
            width: 30%;
            background: #002960;
            color: white;
            padding: 15px;
            border: 2px solid #002960;
            text-align: center;
        }

        .entreprise-nom {
            color: #002960;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        /* Sections */
        .section {
            margin-bottom: 20px;
        }

        .section-title {
            background: #002960; /* Couleur solide au lieu du gradient */
            color: white;
            padding: 10px 15px;
            margin-bottom: 15px;
            font-weight: bold;
            font-size: 12px;
            border-left: 4px solid #2c5aa0;
        }

        /* Informations client */
        .client-grid {
            display: table;
            width: 100%;
            background: #fafafa; /* Couleur solide */
            padding: 15px;
            border: 1px solid #dddddd;
        }

        .client-col {
            display: table-cell;
            vertical-align: top;
            width: 50%;
            padding: 0 10px;
        }

        /* Tableau des services */
        .table-services {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            background: white;
            border: 1px solid #dddddd;
        }

        .table-services th {
            background: #002960; /* Couleur solide */
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
            font-size: 11px;
            border: 1px solid #2c5aa0;
        }

        .table-services td {
            padding: 10px;
            border: 1px solid #dddddd;
            vertical-align: top;
        }

        /* Alternance des lignes du tableau */
        .table-services tr:nth-child(odd) {
            background: #fafafa; /* Couleur solide */
        }

        /* Alignements */
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .text-bold { font-weight: bold; }

        /* Totaux - Design simplifié */
        .totaux-container {
            background: #f5f5f5; /* Couleur solide */
            padding: 15px;
            margin-top: 20px;
            border: 1px solid #dddddd;
            border-left: 4px solid #002960;
        }

        .ligne-totaux {
            display: table;
            width: 100%;
            padding: 5px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .ligne-label, .ligne-montant {
            display: table-cell;
            padding: 3px 0;
        }

        .ligne-montant {
            text-align: right;
            width: 30%;
        }

        .total-final {
            font-size: 14px;
            font-weight: bold;
            color: white;
            background: #002960; /* Couleur solide */
            padding: 10px;
            margin-top: 8px;
            border: 1px solid #002960;
        }

        /* Conditions */
        .conditions {
            background: #f9f9f9; /* Couleur solide */
            padding: 15px;
            margin-top: 25px;
            border: 1px solid #dddddd;
            border-left: 4px solid #27ae60;
        }

        .conditions ul {
            padding-left: 20px;
            margin: 8px 0;
        }

        .conditions li {
            margin-bottom: 3px;
        }

        /* Signature */
        .signature-section {
            margin-top: 40px;
            display: table;
            width: 100%;
        }

        .signature-box {
            display: table-cell;
            text-align: center;
            width: 50%;
        }

        .signature-line {
            border-top: 1px solid #002960;
            width: 80%;
            margin: 15px auto 5px;
            padding-top: 8px;
        }

        /* Pied de page */
        .footer {
            margin-top: 75px;
            padding-top: 15px;
            border-top: 2px solid #002960;
            text-align: center;
            font-size: 9px;
            color: #666;
        }

        /* Détails des services */
        .service-details {
            font-size: 10px;
            color: #666;
            margin-top: 2px;
            font-style: italic;
        }

        /* Mise en valeur des prix */
        .prix {
            font-weight: bold;
            color: #002960;
        }

        .montant-total {
            font-size: 12px;
            font-weight: bold;
            color: #002960;
        }

        /* Badge statut */
        .badge {
            display: inline-block;
            padding: 2px 6px;
            background: #002960;
            color: white;
            border-radius: 2px;
            font-size: 9px;
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo-section">
                <img src="{{ asset(config('company.logo')) }}" alt="Logo {{ config('company.name') }}" class="logo">
                <div class="entreprise-nom">{{ config('company.name') }}</div>
            </div>
            
            <div class="devis-info">
                <div style="font-size: 12px; margin-bottom: 8px;">DEVIS</div>
                <div style="font-size: 16px; font-weight: bold; margin: 8px 0;">N° {{ $devis['numero'] }}</div>
                <div style="font-size: 10px;">
                    Émis le: {{ $devis['date_emission'] }}<br>
                    Valide jusqu'au: {{ $devis['date_validite'] }}<br>
                </div>
            </div>
        </div>

        <!-- Informations client -->
        <div class="section">
            <div class="section-title">INFORMATIONS CLIENT</div>
            <div class="client-grid">
                <div class="client-col">
                    <strong style="color: #002960; font-size: 12px;">{{ $client['nom'] }}</strong><br>
                    {{ $client['contact'] }}<br>
                    {{ $client['adresse'] }} - {{ $client['code_postal'] }} {{ $client['ville'] }}
                </div>
                <div class="client-col">
                    @if(isset($client['telephone']))
                    <strong>Téléphone:</strong> {{ $client['telephone'] }}<br>
                    @endif
                    @if(isset($client['email']))
                    <strong>Email:</strong> {{ $client['email'] }}<br>
                    @endif
                    @if(isset($devis['objet']))
                    <strong>Objet:</strong> {{ $devis['objet'] }}
                    @endif
                </div>
            </div>
        </div>

        <!-- Détail des prestations -->
        <div class="section">
            <div class="section-title">DÉTAIL DES PRESTATIONS</div>
            
            <table class="table-services">
                <thead>
                    <tr>
                        <th width="60%">Description du service</th>
                        <th width="20%" class="text-center">Quantité</th>
                        <th width="20%" class="text-right">Total HT</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                        $totalHT = 0;
                        $tauxTVA = $service['tva'];
                    @endphp
                    
                    @php 
                        $totalLigne = $service['prix'];
                        $totalHT += $totalLigne;
                    @endphp
                    <tr>
                        <td>
                            <strong>{{ $service['description'] }}</strong>
                            @if(isset($service['details']) && $service['details'])
                            <div class="service-details">{{ $service['details'] }}</div>
                            @endif
                        </td>
                        <td class="text-center">{{ $service['quantite'] }}</td>
                        <td class="text-right montant-total">{{ number_format($totalLigne, 2, ',', ' ') }} TND</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Calcul des totaux -->
        @php
            $montantTVA = $totalHT * ($tauxTVA/100);
            $totalTTC = $totalHT + $montantTVA;
        @endphp

        <div class="totaux-container">
            <div class="ligne-totaux">
                <div class="ligne-label">TVA ({{ $tauxTVA }}%):</div>
                <div class="ligne-montant prix">{{ number_format($montantTVA, 2, ',', ' ') }} TND</div>
            </div>
            
            <div class="ligne-totaux total-final">
                <div class="ligne-label">TOTAL TTC:</div>
                <div class="ligne-montant">{{ number_format($totalTTC, 2, ',', ' ') }} TND</div>
            </div>
        </div>

        <!-- Conditions générales -->
        <div class="conditions">
            <div class="section-title">CONDITIONS GÉNÉRALES</div>
            <p><strong>Validité:</strong> Ce devis est valable {{$devis['validite']}} jours à compter de la date d'émission.</p>
            <p><strong>Paiement:</strong> 
                {{ $devis['conditions_paiement'] }}
            </p>
            <p><strong>Délai de réalisation:</strong> 
                {{ $devis['delai'] }}
            </p>
        </div>

        <!-- Signature -->
        <div class="signature-section">
            
            <div class="signature-box"></div>
            <div class="signature-box">
                <p>Pour <strong>{{ config('company.name') }}</strong></p>
                <div class="signature-line">
                    Le {{ $devis['date_emission'] }}<br>
                    <em>Signature et cachet</em>
                </div>
            </div>
        </div>

        <!-- Pied de page -->
        <div class="footer">
            <p>{{ config('company.name') }} - {{ config('company.address') }} - {{ config('company.code_postal') }} {{ config('company.ville') }} - 
               Tél: {{ config('company.phone') }} - Email: {{ config('company.email') }}</p>
        </div>
    </div>
</body>
</html>