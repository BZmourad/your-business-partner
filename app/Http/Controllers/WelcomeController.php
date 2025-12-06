<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Contact;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactNotification;

class WelcomeController extends Controller
{
    protected $mailNotify = "ybp.businesstn@gmail.com";

    protected $services = [
        [
            'image' => 'welcome/assets/img/services/creation_entreprises.jpg',
            'slug' => 'creation_entreprises',
            'name' => 'Création d\'entreprises',
            'description' => 'Accompagnement complet pour la création de votre entreprise en Tunisie',
            'icon' => 'fas fa-building',
            'cards' => [
                [
                    'title' => 'Legal Structure Selection',
                    'description' => 'Expert guidance in choosing the optimal legal structure for your business in Tunisia (SARL, SA, SUARL, etc.). We analyze your needs to recommend the most tax-efficient and suitable company form.'
                ],
                [
                    'title' => 'Registration Process Management',
                    'description' => 'Complete handling of all registration formalities with Tunisian authorities including the Trade Register, Tax Administration, and Social Security. We ensure smooth and efficient company setup.'
                ],
                [
                    'title' => 'Tax Registration & Compliance',
                    'description' => 'Comprehensive tax registration services including VAT number acquisition, corporate tax identification, and initial tax compliance setup to ensure your business starts on solid legal footing.'
                ],
                [
                    'title' => 'Post-Incorporation Services',
                    'description' => 'Ongoing support after company creation including statutory book setup, initial accounting organization, and first tax declaration guidance to ensure continuous compliance from day one.'
                ]
            ],
            'items' => [
                [
                    'icon' => 'fas fa-building',
                    'title' => 'Company Formation',
                    'description' => 'Complete incorporation services for all types of Tunisian business entities with optimized legal and tax structures.'
                ],
                [
                    'icon' => 'fas fa-file-signature',
                    'title' => 'Legal Documentation',
                    'description' => 'Preparation of all required legal documents including statutes, shareholder agreements, and registration forms.'
                ],
                [
                    'icon' => 'fas fa-passport',
                    'title' => 'Foreign Investment',
                    'description' => 'Specialized support for foreign investors including approval processes and compliance with Tunisian investment laws.'
                ],
                [
                    'icon' => 'fas fa-hand-holding-usd',
                    'title' => 'Tax Incentives',
                    'description' => 'Guidance on available tax benefits and incentives for new businesses in Tunisia to optimize your fiscal position.'
                ]
            ],
            'advantage_description' => 'Our company creation service provides a comprehensive solution that combines legal expertise with strategic tax planning. We ensure your business is established with the optimal structure for growth and compliance in the Tunisian market.',
            'advantages' => [
                'Fast and Efficient Registration Process',
                'Tax-Optimized Business Structure',
                'Complete Compliance from Day One'
            ],
            'categories' => [
                ['icon' => 'fas fa-building', 'name' => 'SARL Formation'],
                ['icon' => 'fas fa-chess-queen', 'name' => 'SA Creation'],
                ['icon' => 'fas fa-globe', 'name' => 'Foreign Investment'],
                ['icon' => 'fas fa-file-contract', 'name' => 'Legal Documentation'],
                ['icon' => 'fas fa-hand-holding-usd', 'name' => 'Tax Registration']
            ],
            'tags' => ['Company Formation', 'Business Setup', 'Legal Structure', 'Registration', 'Tax Optimization', 'Compliance']
        ],
        [
            'image' => 'welcome/assets/img/services/conseil_fiscal_entreprises.jpg',
            'slug' => 'conseil_fiscal_entreprises',
            'name' => 'Conseil fiscal aux entreprises',
            'description' => 'Optimisation fiscale et conseil stratégique pour votre entreprise',
            'icon' => 'fas fa-chart-line',
            'cards' => [
                [
                    'title' => 'Tax Optimization Strategies',
                    'description' => 'Development of customized tax strategies to minimize liabilities while ensuring full compliance with Tunisian tax regulations and international standards.'
                ],
                [
                    'title' => 'VAT Compliance & Management',
                    'description' => 'Complete VAT management including registration, declaration preparation, credit recovery, and audit support for businesses operating in Tunisia.'
                ],
                [
                    'title' => 'Corporate Tax Planning',
                    'description' => 'Strategic planning for corporate income tax, dividend distribution, and tax-efficient structuring of business operations and transactions.'
                ],
                [
                    'title' => 'Tax Audit Support',
                    'description' => 'Comprehensive support during tax audits including document preparation, representation before tax authorities, and dispute resolution.'
                ]
            ],
            'items' => [
                [
                    'icon' => 'fas fa-chart-pie',
                    'title' => 'Tax Analysis',
                    'description' => 'Detailed analysis of your current tax position and identification of optimization opportunities.'
                ],
                [
                    'icon' => 'fas fa-file-invoice-dollar',
                    'title' => 'VAT Services',
                    'description' => 'Full VAT compliance including registration, declaration, and credit management services.'
                ],
                [
                    'icon' => 'fas fa-balance-scale',
                    'title' => 'Transfer Pricing',
                    'description' => 'Transfer pricing documentation and compliance services for international group operations.'
                ],
                [
                    'icon' => 'fas fa-shield-alt',
                    'title' => 'Tax Risk Management',
                    'description' => 'Identification and mitigation of tax risks to protect your business from unexpected liabilities.'
                ]
            ],
            'advantage_description' => 'Our fiscal consulting service combines deep knowledge of Tunisian tax laws with strategic business insight to optimize your tax position while ensuring full compliance and minimizing risks.',
            'advantages' => [
                'Expert Knowledge of Tunisian Tax Regulations',
                'Customized Tax Optimization Strategies',
                'Proactive Risk Management and Compliance'
            ],
            'categories' => [
                ['icon' => 'fas fa-chart-pie', 'name' => 'Tax Optimization'],
                ['icon' => 'fas fa-file-invoice', 'name' => 'VAT Management'],
                ['icon' => 'fas fa-building', 'name' => 'Corporate Tax'],
                ['icon' => 'fas fa-globe', 'name' => 'International Tax'],
                ['icon' => 'fas fa-balance-scale', 'name' => 'Tax Disputes']
            ],
            'tags' => ['Tax Consulting', 'VAT Compliance', 'Tax Optimization', 'Corporate Tax', 'Tax Audit', 'Fiscal Planning']
        ],
        [
            'image' => 'welcome/assets/img/services/arbitrage_mediation.jpg',
            'slug' => 'arbitrage_mediation',
            'name' => 'Arbitrage et médiation',
            'description' => 'Résolution des conflits commerciaux par arbitrage et médiation professionnelle',
            'icon' => 'fas fa-balance-scale',
            'cards' => [
                [
                    'title' => 'Commercial Arbitration',
                    'description' => 'Binding arbitration services for commercial disputes, providing a faster and more cost-effective alternative to traditional court proceedings with enforceable decisions.'
                ],
                [
                    'title' => 'Mediation Services',
                    'description' => 'Facilitated negotiation through professional mediation to help parties reach mutually acceptable agreements without litigation.'
                ],
                [
                    'title' => 'Dispute Resolution Strategies',
                    'description' => 'Development of effective dispute resolution strategies tailored to the specific nature of commercial conflicts and business relationships.'
                ],
                [
                    'title' => 'Contractual Dispute Management',
                    'description' => 'Expert handling of contractual disputes including interpretation, breach of contract, and performance-related conflicts.'
                ]
            ],
            'items' => [
                [
                    'icon' => 'fas fa-gavel',
                    'title' => 'Arbitration Proceedings',
                    'description' => 'Management of complete arbitration proceedings from initiation to final award.'
                ],
                [
                    'icon' => 'fas fa-handshake',
                    'title' => 'Mediation Facilitation',
                    'description' => 'Professional mediation services to facilitate constructive dialogue and agreement.'
                ],
                [
                    'icon' => 'fas fa-file-contract',
                    'title' => 'Dispute Clause Drafting',
                    'description' => 'Drafting effective dispute resolution clauses for commercial contracts.'
                ],
                [
                    'icon' => 'fas fa-balance-scale',
                    'title' => 'Expert Representation',
                    'description' => 'Expert representation in arbitration and mediation proceedings.'
                ]
            ],
            'advantage_description' => 'Our arbitration and mediation services provide efficient, confidential, and expert resolution of commercial disputes, saving time and costs while preserving business relationships.',
            'advantages' => [
                'Faster Resolution Than Court Proceedings',
                'Confidential and Private Process',
                'Cost-Effective Dispute Resolution'
            ],
            'categories' => [
                ['icon' => 'fas fa-gavel', 'name' => 'Commercial Arbitration'],
                ['icon' => 'fas fa-handshake', 'name' => 'Mediation'],
                ['icon' => 'fas fa-file-contract', 'name' => 'Contract Disputes'],
                ['icon' => 'fas fa-users', 'name' => 'Partnership Disputes'],
                ['icon' => 'fas fa-industry', 'name' => 'Commercial Conflicts']
            ],
            'tags' => ['Arbitration', 'Mediation', 'Dispute Resolution', 'Commercial Conflicts', 'Legal Disputes', 'Conflict Management']
        ],
        [
            'image' => 'welcome/assets/img/services/domiciliation.jpg',
            'slug' => 'domiciliation',
            'name' => 'Domiciliation',
            'description' => 'Services de domiciliation commerciale avec gestion de courrier',
            'icon' => 'fas fa-map-marker-alt',
            'cards' => [
                [
                    'title' => 'Prestigious Business Address',
                    'description' => 'Professional business address in prime locations across Tunisia to enhance your corporate image and credibility with clients and partners.'
                ],
                [
                    'title' => 'Mail & Parcel Management',
                    'description' => 'Comprehensive mail and parcel reception, sorting, scanning, and forwarding services to ensure you never miss important communications.'
                ],
                [
                    'title' => 'Meeting Room Access',
                    'description' => 'Access to fully equipped meeting rooms and conference facilities for client meetings, presentations, and team sessions.'
                ],
                [
                    'title' => 'Call Answering Services',
                    'description' => 'Professional call answering and message forwarding services to maintain excellent customer service and business availability.'
                ]
            ],
            'items' => [
                [
                    'icon' => 'fas fa-map-marker-alt',
                    'title' => 'Business Address',
                    'description' => 'Professional business address in strategic locations for corporate correspondence.'
                ],
                [
                    'icon' => 'fas fa-envelope',
                    'title' => 'Mail Handling',
                    'description' => 'Secure reception, sorting, and forwarding of all business mail and parcels.'
                ],
                [
                    'icon' => 'fas fa-phone',
                    'title' => 'Call Services',
                    'description' => 'Professional call answering and message management services.'
                ],
                [
                    'icon' => 'fas fa-users',
                    'title' => 'Meeting Facilities',
                    'description' => 'Access to meeting rooms and conference facilities with modern equipment.'
                ]
            ],
            'advantage_description' => 'Our domiciliation service provides all the benefits of a professional office address without the overhead costs, allowing businesses to establish a credible presence while focusing resources on core activities.',
            'advantages' => [
                'Professional Business Image',
                'Cost-Effective Office Solution',
                'Flexible Terms and Locations'
            ],
            'categories' => [
                ['icon' => 'fas fa-map-pin', 'name' => 'Tunis Center'],
                ['icon' => 'fas fa-building', 'name' => 'Premium Addresses'],
                ['icon' => 'fas fa-envelope', 'name' => 'Mail Services']
            ],
            'tags' => ['Domiciliation', 'Virtual Office', 'Business Address', 'Mail Handling', 'Meeting Rooms', 'Call Services']
        ],
        [
            'image' => 'welcome/assets/img/services/etudes_projets.jpg',
            'slug' => 'etudes_projets',
            'name' => 'Études de Projets',
            'description' => 'Analyse et études de faisabilité pour vos projets d\'investissement',
            'icon' => 'fas fa-clipboard-check',
            'cards' => [
                [
                    'title' => 'Feasibility Studies',
                    'description' => 'Comprehensive feasibility analysis covering technical, financial, and market aspects to assess project viability and potential returns on investment.'
                ],
                [
                    'title' => 'Market Research & Analysis',
                    'description' => 'In-depth market research to understand industry dynamics, competition, customer behavior, and growth opportunities in the Tunisian market.'
                ],
                [
                    'title' => 'Financial Projections',
                    'description' => 'Detailed financial modeling including revenue forecasts, cost analysis, cash flow projections, and investment return calculations.'
                ],
                [
                    'title' => 'Risk Assessment',
                    'description' => 'Identification and analysis of potential risks including market, operational, financial, and regulatory risks with mitigation strategies.'
                ]
            ],
            'items' => [
                [
                    'icon' => 'fas fa-chart-line',
                    'title' => 'Market Analysis',
                    'description' => 'Comprehensive market research and competitive analysis for informed decision making.'
                ],
                [
                    'icon' => 'fas fa-calculator',
                    'title' => 'Financial Modeling',
                    'description' => 'Detailed financial projections and investment analysis for project evaluation.'
                ],
                [
                    'icon' => 'fas fa-exclamation-triangle',
                    'title' => 'Risk Analysis',
                    'description' => 'Identification and assessment of project risks with mitigation strategies.'
                ],
                [
                    'icon' => 'fas fa-file-alt',
                    'title' => 'Project Reports',
                    'description' => 'Professional project study reports for investors and decision makers.'
                ]
            ],
            'advantage_description' => 'Our project study service provides comprehensive, data-driven analysis to support informed investment decisions, reducing uncertainty and maximizing the chances of project success in the Tunisian market.',
            'advantages' => [
                'Data-Driven Decision Support',
                'Comprehensive Risk Assessment',
                'Market-Specific Insights'
            ],
            'categories' => [
                ['icon' => 'fas fa-industry', 'name' => 'Industrial Projects'],
                ['icon' => 'fas fa-shopping-cart', 'name' => 'Commercial Projects'],
                ['icon' => 'fas fa-home', 'name' => 'Real Estate Projects'],
                ['icon' => 'fas fa-leaf', 'name' => 'Renewable Energy'],
                ['icon' => 'fas fa-laptop', 'name' => 'Technology Projects']
            ],
            'tags' => ['Feasibility Studies', 'Market Research', 'Project Analysis', 'Investment Studies', 'Business Planning', 'Risk Assessment']
        ],
        [
            'image' => 'welcome/assets/img/services/conseil_investissement_finance.jpg',
            'slug' => 'conseil_investissement_finance',
            'name' => 'Conseil en investissement et finance d\'entreprise',
            'description' => 'Services leasing, assurance et financement d\'entreprise',
            'icon' => 'fas fa-hand-holding-usd',
            'cards' => [
                [
                    'title' => 'Investment Consulting',
                    'description' => 'Strategic investment advice including market entry strategies, partnership opportunities, and investment structure optimization for maximum returns.'
                ],
                [
                    'title' => 'Leasing Solutions',
                    'description' => 'Comprehensive leasing services for equipment, vehicles, and real estate with competitive terms from multiple financial partners.'
                ],
                [
                    'title' => 'Corporate Financing',
                    'description' => 'Assistance in securing business financing including bank loans, investment capital, and government funding programs.'
                ],
                [
                    'title' => 'Insurance Services',
                    'description' => 'Corporate insurance solutions including property, liability, professional indemnity, and employee benefits insurance.'
                ]
            ],
            'items' => [
                [
                    'icon' => 'fas fa-search-dollar',
                    'title' => 'Investment Opportunities',
                    'description' => 'Identification and evaluation of investment opportunities in Tunisia.'
                ],
                [
                    'icon' => 'fas fa-car',
                    'title' => 'Equipment Leasing',
                    'description' => 'Leasing solutions for vehicles, machinery, and business equipment.'
                ],
                [
                    'icon' => 'fas fa-university',
                    'title' => 'Bank Financing',
                    'description' => 'Assistance with bank loan applications and financing negotiations.'
                ],
                [
                    'icon' => 'fas fa-shield-alt',
                    'title' => 'Insurance Coverage',
                    'description' => 'Comprehensive business insurance solutions and risk management.'
                ]
            ],
            'advantage_description' => 'Our investment and finance consulting service connects businesses with optimal financing solutions and investment opportunities, combining financial expertise with deep market knowledge to support business growth and expansion.',
            'advantages' => [
                'Access to Multiple Financing Sources',
                'Expert Investment Analysis',
                'Comprehensive Financial Solutions'
            ],
            'categories' => [
                ['icon' => 'fas fa-chart-line', 'name' => 'Investment Advisory'],
                ['icon' => 'fas fa-car', 'name' => 'Vehicle Leasing'],
                ['icon' => 'fas fa-cogs', 'name' => 'Equipment Leasing'],
                ['icon' => 'fas fa-university', 'name' => 'Bank Financing'],
                ['icon' => 'fas fa-shield-alt', 'name' => 'Corporate Insurance']
            ],
            'tags' => ['Investment Consulting', 'Business Financing', 'Leasing Services', 'Corporate Insurance', 'Financial Advisory', 'Capital Raising']
        ],
        [
            'image' => 'welcome/assets/img/services/consulting_immobilier.jpg',
            'slug' => 'consulting_immobilier',
            'name' => 'Consulting immobilier',
            'description' => 'Conseil et accompagnement pour vos projets immobiliers',
            'icon' => 'fas fa-home',
            'cards' => [
                [
                    'title' => 'Property Market Analysis',
                    'description' => 'Comprehensive analysis of Tunisian real estate markets including trends, pricing, and investment opportunities across different regions and property types.'
                ],
                [
                    'title' => 'Investment Property Selection',
                    'description' => 'Expert guidance in selecting investment properties including commercial, residential, industrial, and tourism real estate opportunities.'
                ],
                [
                    'title' => 'Legal Due Diligence',
                    'description' => 'Thorough legal review of property transactions including title verification, zoning compliance, and contract analysis.'
                ],
                [
                    'title' => 'Property Management Consulting',
                    'description' => 'Advice on property management strategies including leasing, maintenance, and optimization of real estate assets.'
                ]
            ],
            'items' => [
                [
                    'icon' => 'fas fa-search',
                    'title' => 'Property Research',
                    'description' => 'Market research and property identification based on investment criteria.'
                ],
                [
                    'icon' => 'fas fa-file-contract',
                    'title' => 'Transaction Support',
                    'description' => 'Assistance with purchase agreements, negotiations, and transaction completion.'
                ],
                [
                    'icon' => 'fas fa-balance-scale',
                    'title' => 'Legal Verification',
                    'description' => 'Due diligence on property titles, permits, and legal compliance.'
                ],
                [
                    'icon' => 'fas fa-chart-line',
                    'title' => 'Investment Analysis',
                    'description' => 'Financial analysis and ROI calculation for real estate investments.'
                ]
            ],
            'advantage_description' => 'Our real estate consulting service combines market expertise with legal and financial analysis to help clients make informed real estate decisions, whether for investment, development, or operational purposes in Tunisia.',
            'advantages' => [
                'Deep Market Knowledge',
                'Comprehensive Due Diligence',
                'End-to-End Transaction Support'
            ],
            'categories' => [
                ['icon' => 'fas fa-building', 'name' => 'Commercial Real Estate'],
                ['icon' => 'fas fa-home', 'name' => 'Residential Properties'],
                ['icon' => 'fas fa-industry', 'name' => 'Industrial Properties'],
                ['icon' => 'fas fa-umbrella-beach', 'name' => 'Tourism Real Estate'],
                ['icon' => 'fas fa-hard-hat', 'name' => 'Development Projects']
            ],
            'tags' => ['Real Estate Consulting', 'Property Investment', 'Real Estate Market', 'Property Transactions', 'Real Estate Due Diligence', 'Property Management']
        ],
        [
            'image' => 'welcome/assets/img/services/business_pro_services.jpg',
            'slug' => 'business_pro_services',
            'name' => 'Business Pro Services',
            'description' => 'Services VIP : réservations, visas, location voiture, hébergement web, etc.',
            'icon' => 'fas fa-star',
            'cards' => [
                [
                    'title' => 'Travel & Accommodation Services',
                    'description' => 'Premium travel arrangements including flight bookings, VIP airport reception, luxury hotel reservations, and chauffeur-driven car rental services across Tunisia.'
                ],
                [
                    'title' => 'Visa & Immigration Assistance',
                    'description' => 'Comprehensive visa application support, residence permit processing, and immigration compliance services for international business travelers and expatriates.'
                ],
                [
                    'title' => 'Digital & Professional Services',
                    'description' => 'Complete digital solutions including website development, hosting, graphic design, printing services, and professional translation in multiple languages.'
                ],
                [
                    'title' => 'Event & Business Support',
                    'description' => 'Professional event organization for seminars and conferences, plus essential business support services including bank account opening and administrative assistance.'
                ]
            ],
            'items' => [
                [
                    'icon' => 'fas fa-plane',
                    'title' => 'Travel Services',
                    'description' => 'Flight bookings, VIP airport reception, and premium accommodation arrangements.'
                ],
                [
                    'icon' => 'fas fa-passport',
                    'title' => 'Visa Services',
                    'description' => 'Visa application assistance and residence permit processing.'
                ],
                [
                    'icon' => 'fas fa-laptop-code',
                    'title' => 'Digital Solutions',
                    'description' => 'Website development, hosting, and digital marketing services.'
                ],
                [
                    'icon' => 'fas fa-users',
                    'title' => 'Event Management',
                    'description' => 'Organization of seminars, conferences, and business events.'
                ]
            ],
            'advantage_description' => 'Our Business Pro Services provide comprehensive support for all business needs beyond core operations, allowing companies to focus on their core activities while we handle travel, administrative, and support requirements with premium quality service.',
            'advantages' => [
                'One-Stop Solution for Business Support',
                'Premium Quality Service Standards',
                'Time and Cost Efficiency'
            ],
            'categories' => [
                ['icon' => 'fas fa-plane', 'name' => 'Travel Services'],
                ['icon' => 'fas fa-passport', 'name' => 'Visa Assistance'],
                ['icon' => 'fas fa-car', 'name' => 'Car Rental'],
                ['icon' => 'fas fa-laptop', 'name' => 'Web Services'],
                ['icon' => 'fas fa-users', 'name' => 'Event Organization']
            ],
            'tags' => ['Business Services', 'Travel Arrangements', 'Visa Assistance', 'Car Rental', 'Web Development', 'Event Management']
        ]
    ];

    protected $teams = [
        [
            "image" => 'welcome/assets/img/team/team-1.jpeg',
            "facebook" => "https://www.facebook.com/Cabinetlotfialimijurifisc",
            "twitter" => "",
            "linkedin" => "https://tn.linkedin.com/in/lotfi-alimi-b23a59130",
            "instagram" => "",
            "name" => "Maître Lotfi Alimi",
            "titre" => "Manager",
            "tiktok" => "https://www.tiktok.com/@yourbusinesspartnertn?is_from_webapp=1&sender_device=pc"
        ]
    ];

    protected $testimonials = [
        [
            'name' => 'Karim Ben Ali',
            'position' => 'CEO - Tech Startup Tunisia',
            'comment' => 'YBP made our company creation process in Tunisia seamless and efficient. Their team handled all legal formalities, tax registration, and even helped us secure office space. Thanks to their comprehensive services, we launched operations 3 months ahead of schedule.',
            'rating' => 5,
            'image' => 'welcome/assets/img/client/client-img1.png'
        ],
        [
            'name' => 'Sophie Martin',
            'position' => 'Director - European Investment Group',
            'comment' => 'As an international investor, navigating Tunisian regulations was challenging. YBP provided exceptional investment consulting and fiscal advice. Their leasing assistance and project study services were instrumental in our successful market entry.',
            'rating' => 5,
            'image' => 'welcome/assets/img/client/client-img4.png'
        ],
        [
            'name' => 'Mohamed Trad',
            'position' => 'Operations Manager - Manufacturing Company',
            'comment' => 'The arbitration and mediation service from YBP resolved our commercial dispute efficiently, saving us time and legal costs. Their business pro services, especially visa assistance and hotel bookings, have been invaluable for our international partners.',
            'rating' => 5,
            'image' => 'welcome/assets/img/client/client-img3.png'
        ],
        [
            'name' => 'Lina Chakroun',
            'position' => 'Entrepreneur - Real Estate Developer',
            'comment' => 'YBP\'s consulting services cover all business needs. Their real estate consulting helped us identify prime investment opportunities, while their domiciliation service provides a professional business address. The team is always responsive and professional.',
            'rating' => 5,
            'image' => 'welcome/assets/img/client/client-img2.png'
        ]
    ];

    protected $faqs = [
        [
            'question' => 'How long does it take to create a company in Tunisia with YBP?',
            'answer' => 'The company creation process typically takes 2-4 weeks, depending on the company type and required approvals. With our streamlined process and expertise, we accelerate all administrative procedures to get your business operational as quickly as possible.',
            'active' => true
        ],
        [
            'question' => 'Can YBP help foreign investors open a business in Tunisia?',
            'answer' => 'Yes, we specialize in assisting foreign investors. Our services include legal setup, tax registration, bank account opening, residence permits for expatriates, and ongoing compliance support. We provide guidance on investment laws and incentives available in Tunisia.',
            'active' => false
        ],
        [
            'question' => 'What services are included in Business Pro Services?',
            'answer' => 'Our Business Pro Services package includes: flight bookings, VIP airport reception, visa assistance, car rental (with/without driver), premium hotel reservations, GSM phone lines, translation services, event organization, web development/hosting, graphic design, printing services, residence permit assistance, and foreign currency bank account opening.',
            'active' => false
        ],
        [
            'question' => 'Do you offer leasing services for equipment and vehicles?',
            'answer' => 'Yes, through our finance and investment consulting service, we provide comprehensive leasing solutions for equipment, vehicles, and machinery. We work with multiple financial institutions to secure the best terms for your business needs.',
            'active' => false
        ],
        [
            'question' => 'What is the difference between arbitration and mediation services?',
            'answer' => 'Arbitration is a binding dispute resolution where an arbitrator makes a final decision. Mediation is a non-binding process where a mediator facilitates negotiations between parties to reach a voluntary agreement. We offer both services to resolve commercial disputes efficiently.',
            'active' => false
        ],
        [
            'question' => 'Can YBP help with real estate investment in Tunisia?',
            'answer' => 'Absolutely. Our real estate consulting covers market analysis, property valuation, legal due diligence, purchase assistance, rental management, and investment structuring for both residential and commercial properties.',
            'active' => false
        ],
        [
            'question' => 'What documents are needed for domiciliation services?',
            'answer' => 'For domiciliation, we need: company registration documents, identification of legal representatives, proof of address for directors, and completed application forms. We provide a prestigious business address, mail handling, and meeting room access.',
            'active' => false
        ],
        [
            'question' => 'Do you offer services in languages other than Arabic?',
            'answer' => 'Yes, our team is multilingual and we provide services in Arabic, French, English, and Italian. All our documentation can be prepared in these languages, and our translation service covers additional languages as needed.',
            'active' => false
        ],
        [
            'question' => 'How does YBP ensure data confidentiality?',
            'answer' => 'We adhere to strict confidentiality agreements with all clients. Our systems are secure, and access to client information is restricted to authorized personnel only. We comply with Tunisian data protection laws and professional secrecy requirements.',
            'active' => false
        ],
        [
            'question' => 'What support do you provide after company creation?',
            'answer' => 'Our support continues with fiscal consulting, accounting assistance, annual compliance filings, business development advice, and access to all our Business Pro Services. We offer monthly or quarterly review meetings to ensure ongoing compliance and optimization.',
            'active' => true
        ]
    ];

    public function index(Request $request){
        if (env('MODE_VITRINE', 0) == -1) {
            return redirect()->route('home');
        }
        $lang = 'fr';
        if (auth()->check()) {
            $lang = auth()->user()->lang;
        } else {
            $browserLanguages = $request->getLanguages();
            foreach ($browserLanguages as $browserLanguage) {
                $simpleLocale = explode('-', $browserLanguage)[0];
                if (in_array($simpleLocale, ['ar', 'fr', 'en'])) {
                    $lang = $simpleLocale;
                }
            }
        }
        return redirect()->route($lang.'.welcome');
    }

    public function index_en(){
        if (env('MODE_VITRINE', 0) == -1) {
            return redirect()->route('home');
        }
        $l = "en";
        $services = $this->services;
        $teams = $this->teams;
        $testimonials = $this->testimonials;
        $faqs = $this->faqs;
        $this->setHomeSEO($l);
        return view('welcome.index', compact('l', 'services', 'teams', 'testimonials', 'faqs'));
    }

    public function index_fr(){
        if (env('MODE_VITRINE', 0) == -1) {
            return redirect()->route('home');
        }
        $l = "fr";
        $services = $this->services;
        $teams = $this->teams;
        $testimonials = $this->testimonials;
        $faqs = $this->faqs;
        $this->setHomeSEO($l);
        return view('welcome.index', compact('l', 'services', 'teams', 'testimonials', 'faqs'));
    }

    public function index_ar(){
        if (env('MODE_VITRINE', 0) == -1) {
            return redirect()->route('home');
        }
        $l = "ar";
        $services = $this->services;
        $teams = $this->teams;
        $testimonials = $this->testimonials;
        $faqs = $this->faqs;
        $this->setHomeSEO($l);
        return view('welcome.index', compact('l', 'services', 'teams', 'testimonials', 'faqs'));
    }

    public function service_en($slug){
        if (env('MODE_VITRINE', 0) == -1) {
            return redirect()->route('home');
        }
        $l = "en";
        $services = $this->services;
        $service = $this->getServiceDetail($slug);
        $this->setServiceSEO($l, $service);
        return view('welcome.service', compact('l', 'slug', 'services', 'service'));
    }

    public function service_fr($slug){
        if (env('MODE_VITRINE', 0) == -1) {
            return redirect()->route('home');
        }
        $l = "fr";
        $services = $this->services;
        $service = $this->getServiceDetail($slug);
        $this->setServiceSEO($l, $service);
        return view('welcome.service', compact('l', 'slug', 'services', 'service'));
    }

    public function service_ar($slug){
        if (env('MODE_VITRINE', 0) == -1) {
            return redirect()->route('home');
        }
        $l = "ar";
        $services = $this->services;
        $service = $this->getServiceDetail($slug);
        $this->setServiceSEO($l, $service);
        return view('welcome.service', compact('l', 'slug', 'services', 'service'));
    }

    public function contact(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'service' => 'nullable',
                'email' => 'nullable|email',
                'phone' => 'required|string',
                'address' => 'nullable|string',
                'subject' => 'required|string',
                'message' => 'required|string|min:10'
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()]);
            }
            DB::beginTransaction();
            $contact = Contact::create($request->all());
            $contact->update(['reference'=>getRefrence($contact->id, "CT")]);
            $contactData = $request->all();
            Mail::to($this->mailNotify)->send(new ContactNotification($contactData));
            DB::commit();
            return response()->json(['success' => __('Action successfully completed.')]);
        } catch (\Exception $e) {
            DB::rollBack();
            elog($e);
            return response()->json(['error' =>  __('Une erreur est survenue. Veuillez réessayer.')]);
        }
    }

    private function getServiceDetail($slug){
        $service = $this->services[0];
        foreach ($this->services as $s) {
            if ($s['slug'] == $slug) {
                $service = $s;
            }
        }
        return $service;
    }

    private function setHomeSEO($lang){
        if (env('SEO_ACTIVE', 1) == 1) {
            
            // Titres SEO optimisés par langue
            $titles = [
                'fr' => 'Your Business Partner (YBP) - Services Complets pour Entreprises en Tunisie | Création Société, Conseil Fiscal',
                'ar' => 'شريكك التجاري (YBP) - خدمات متكاملة للشركات في تونس | تأسيس الشركات، الاستشارات الضريبية',
                'en' => 'Your Business Partner (YBP) - Complete Business Services in Tunisia | Company Formation, Tax Consulting'
            ];
            
            $defaultTitle = __('Your Business Partner (YBP) - Professional Business Services in Tunisia', [], $lang);
            SEOTools::setTitle($titles[$lang] ?? $defaultTitle);
            
            // Descriptions SEO optimisées par langue
            $descriptions = [
                'fr' => 'YBP Tunisie : Création d\'entreprises, conseil fiscal, arbitrage, domiciliation, études de projets, financement, consulting immobilier et services business VIP. Votre partenaire pour réussir en Tunisie. Experts depuis 15 ans.',
                'ar' => 'YBP تونس: تأسيس الشركات، الاستشارات الضريبية، التحكيم، التوطين، دراسات المشاريع، التمويل، الاستشارات العقارية وخدمات الأعمال VIP. شريكك للنجاح في تونس. خبرة 15 سنة.',
                'en' => 'YBP Tunisia: Company formation, tax consulting, arbitration, business address services, project studies, financing, real estate consulting and VIP business services. Your partner for success in Tunisia. 15 years expertise.'
            ];
            
            SEOTools::setDescription($descriptions[$lang] ?? $defaultTitle);
            
            // Mots-clés optimisés
            $keywordsByLang = [
                'fr' => [
                    'création entreprise Tunisie',
                    'conseil fiscal Tunisie',
                    'arbitrage commercial Tunisie',
                    'domiciliation entreprise Tunisie',
                    'étude projet Tunisie',
                    'financement entreprise Tunisie',
                    'consulting immobilier Tunisie',
                    'services business Tunisie',
                    'YBP Your Business Partner',
                    'investir en Tunisie',
                    'visa Tunisie',
                    'leasing Tunisie',
                    'assurance entreprise Tunisie',
                    'compte bancaire devise Tunisie',
                    'société SARL Tunisie',
                    'création SA Tunisie',
                    'investisseur étranger Tunisie',
                    'business services VIP Tunisie',
                    'résidence Tunisie',
                    'hébergement web Tunisie'
                ],
                'ar' => [
                    'تأسيس شركة تونس',
                    'استشارات ضريبية تونس',
                    'تحكيم تجاري تونس',
                    'توطين شركات تونس',
                    'دراسات مشاريع تونس',
                    'تمويل أعمال تونس',
                    'استشارات عقارية تونس',
                    'خدمات أعمال تونس',
                    'YBP شريكك التجاري',
                    'الاستثمار في تونس',
                    'تأشيرة تونس',
                    'تأجير تمويلي تونس',
                    'تأمين شركات تونس',
                    'فتح حساب مصرفي تونس'
                ],
                'en' => [
                    'company formation Tunisia',
                    'tax consulting Tunisia',
                    'commercial arbitration Tunisia',
                    'business address Tunisia',
                    'feasibility study Tunisia',
                    'business financing Tunisia',
                    'real estate consulting Tunisia',
                    'business services Tunisia',
                    'YBP Tunisia',
                    'investment Tunisia',
                    'visa assistance Tunisia',
                    'equipment leasing Tunisia',
                    'corporate insurance Tunisia',
                    'foreign bank account Tunisia',
                    'SARL company Tunisia',
                    'SA company Tunisia',
                    'foreign investor Tunisia',
                    'VIP business services Tunisia',
                    'residency Tunisia',
                    'web hosting Tunisia'
                ]
            ];
            
            SEOTools::metatags()->addKeyword($keywordsByLang[$lang] ?? []);
            
            // Open Graph optimisé
            SEOTools::opengraph()->setUrl(url()->current());
            SEOTools::opengraph()->addProperty('type', 'website');
            SEOTools::opengraph()->addProperty('locale', $this->getLocaleCode($lang));
            
            $ogTitles = [
                'fr' => 'YBP - Votre Partenaire Business en Tunisie | 8 Services Essentiels',
                'ar' => 'YBP - شريكك التجاري في تونس | 8 خدمات أساسية',
                'en' => 'YBP - Your Business Partner in Tunisia | 8 Essential Services'
            ];
            
            SEOTools::opengraph()->setTitle($ogTitles[$lang] ?? 'YBP Tunisia');
            
            $ogDescriptions = [
                'fr' => 'Création entreprise ✓ Conseil fiscal ✓ Arbitrage ✓ Domiciliation ✓ Études projets ✓ Financement ✓ Consulting immobilier ✓ Services business VIP. Contactez-nous !',
                'ar' => 'تأسيس شركات ✓ استشارات ضريبية ✓ تحكيم ✓ توطين ✓ دراسات مشاريع ✓ تمويل ✓ استشارات عقارية ✓ خدمات أعمال VIP. اتصل بنا!',
                'en' => 'Company formation ✓ Tax consulting ✓ Arbitration ✓ Business address ✓ Project studies ✓ Financing ✓ Real estate consulting ✓ VIP business services. Contact us!'
            ];
            
            SEOTools::opengraph()->setDescription($ogDescriptions[$lang] ?? '');
            
            // Images optimisées pour Open Graph
            $ogImages = [
                [
                    'url' => asset('welcome/assets/img/ybp/1.jpeg'),
                    'alt' => 'YBP Your Business Partner Tunisia - Business Services'
                ],
                asset('welcome/assets/img/ybp/2.jpeg'),
                asset('welcome/assets/img/ybp/3.jpeg'),
                asset('welcome/assets/img/ybp/4.jpeg'),
                asset('welcome/assets/img/ybp/5.jpeg'),
                asset('welcome/assets/img/ybp/6.jpeg')
            ];
            
            foreach ($ogImages as $image) {
                if (is_array($image)) {
                    SEOTools::opengraph()->addImage($image['url']);
                } else {
                    SEOTools::opengraph()->addImage($image);
                }
            }
            
            // Ajouter les métadonnées pour la Tunisie
            SEOTools::opengraph()->addProperty('country-name', 'Tunisia');
            SEOTools::opengraph()->addProperty('region', 'TN');
            
            // JSON-LD Structured Data amélioré
            $this->setEnhancedStructuredData($lang);
            
            // URL Canonical
            SEOTools::setCanonical(url()->current());
            
            // URLs alternatives par langue
            $alternates = [
                'fr' => url('/fr'),
                'ar' => url('/ar'),
                'en' => url('/en')
            ];
            
            foreach ($alternates as $langCode => $url) {
                SEOTools::metatags()->addAlternateLanguage($langCode, $url);
            }
            
            // Métadonnées supplémentaires
            SEOTools::metatags()->addMeta('robots', 'index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1');
            SEOTools::metatags()->addMeta('viewport', 'width=device-width, initial-scale=1');
            SEOTools::metatags()->addMeta('author', 'Your Business Partner Tunisia');
            SEOTools::metatags()->addMeta('copyright', 'Your Business Partner YBP © ' . date('Y'));
            
            // Métadonnées spécifiques pour la Tunisie
            SEOTools::metatags()->addMeta('geo.region', 'TN');
            SEOTools::metatags()->addMeta('geo.placename', 'Tunis');
            SEOTools::metatags()->addMeta('geo.position', '36.81777971732256;10.17965708465764');
            //SEOTools::metatags()->addMeta('ICBM', '36.81777971732256, 10.17965708465764');
            
            // Référencement local
            SEOTools::metatags()->addMeta('business:contact_data:street_address', '85-87 Rue de La Palestine');
            SEOTools::metatags()->addMeta('business:contact_data:locality', 'Tunis');
            SEOTools::metatags()->addMeta('business:contact_data:postal_code', '1002');
            SEOTools::metatags()->addMeta('business:contact_data:country_name', 'Tunisia');
            SEOTools::metatags()->addMeta('business:contact_data:email', 'ybp.businesstn@gmail.com');
            SEOTools::metatags()->addMeta('business:contact_data:phone_number', '+21624674032');
            
        }
    }
    
    private function setEnhancedStructuredData($lang){
        // Construire le tableau de services pour Schema.org
        $serviceOffers = [];
        foreach ($this->services as $service) {
            $serviceOffers[] = [
                '@type' => 'Offer',
                'itemOffered' => [
                    '@type' => 'Service',
                    'name' => __($service['name'], [], $lang),
                    'description' => __($service['description'], [], $lang),
                    'url' => url(route($lang . '.welcome.service', $service['slug'])),
                    'serviceType' => implode(', ', array_map(function($tag) use ($lang) {
                        return __($tag, [], $lang);
                    }, $service['tags']))
                ]
            ];
        }
        
        // Données structurées pour ProfessionalService
        SEOTools::jsonLd()->setType('ProfessionalService');
        
        $companyNames = [
            'fr' => 'Your Business Partner (YBP) - Services Professionnels en Tunisie',
            'ar' => 'شريكك التجاري (YBP) - خدمات مهنية في تونس',
            'en' => 'Your Business Partner (YBP) - Professional Services in Tunisia'
        ];
        
        SEOTools::jsonLd()->setTitle($companyNames[$lang] ?? 'YBP Tunisia');
        
        $companyDescriptions = [
            'fr' => 'Cabinet de services professionnels spécialisé dans la création d\'entreprises, le conseil fiscal, l\'arbitrage commercial, la domiciliation d\'entreprise, les études de projets, le financement, le consulting immobilier et les services business en Tunisie.',
            'ar' => 'مكتب خدمات مهنية متخصص في تأسيس الشركات، الاستشارات الضريبية، التحكيم التجاري، توطين الشركات، دراسات المشاريع، التمويل، الاستشارات العقارية وخدمات الأعمال في تونس.',
            'en' => 'Professional services firm specializing in company formation, tax consulting, commercial arbitration, business address services, project studies, financing, real estate consulting and business services in Tunisia.'
        ];
        
        SEOTools::jsonLd()->setDescription($companyDescriptions[$lang] ?? '');
        SEOTools::jsonLd()->addValue('areaServed', [
            '@type' => 'Country',
            'name' => 'Tunisia'
        ]);
        
        // Données structurées LocalBusiness améliorées
        $jsonLd = \Artesaos\SEOTools\Facades\JsonLdMulti::newJsonLd();
        $jsonLd->setType(['LocalBusiness', 'ProfessionalService']);
        $jsonLd->setTitle('Your Business Partner (YBP)');
        
        // Contact point
        $jsonLd->addValue('contactPoint', [
            '@type' => 'ContactPoint',
            'telephone' => '+21624674032',
            'contactType' => 'customer service',
            'email' => 'ybp.businesstn@gmail.com',
            'availableLanguage' => ['French', 'Arabic', 'English'],
            'areaServed' => 'TN'
        ]);
        
        // Adresse complète
        $jsonLd->addValue('address', [
            '@type' => 'PostalAddress',
            'streetAddress' => '85-87 Rue de La Palestine',
            'addressLocality' => 'Tunis',
            'addressRegion' => 'Tunis',
            'postalCode' => '1002',
            'addressCountry' => 'TN'
        ]);
        
        // Géolocalisation
        $jsonLd->addValue('geo', [
            '@type' => 'GeoCoordinates',
            'latitude' => 36.81777971732256,
            'longitude' => 10.17965708465764
        ]);
        
        // Horaires d'ouverture détaillés
        $jsonLd->addValue('openingHoursSpecification', [
            [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                'opens' => '08:00',
                'closes' => '18:00'
            ],
            [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => 'Saturday',
                'opens' => '09:00',
                'closes' => '13:00'
            ]
        ]);
        
        // Services proposés
        $jsonLd->addValue('makesOffer', $serviceOffers);
        
        // Prix
        $jsonLd->addValue('priceRange', '$$');
        
        // Réseaux sociaux
        $jsonLd->addValue('sameAs', [
            'https://www.facebook.com/Cabinetlotfialimijurifisc',
            'https://tn.linkedin.com/in/lotfi-alimi-b23a59130',
            'https://www.tiktok.com/@yourbusinesspartnertn',
            'https://twitter.com/YBP_Tunisia'
        ]);
        
        // Avis clients
        $reviews = [];
        foreach ($this->testimonials as $testimonial) {
            $reviews[] = [
                '@type' => 'Review',
                'reviewRating' => [
                    '@type' => 'Rating',
                    'ratingValue' => $testimonial['rating'],
                    'bestRating' => '5'
                ],
                'author' => [
                    '@type' => 'Person',
                    'name' => $testimonial['name']
                ],
                'reviewBody' => $testimonial['comment']
            ];
        }
        
        $jsonLd->addValue('aggregateRating', [
            '@type' => 'AggregateRating',
            'ratingValue' => '4.9',
            'reviewCount' => count($this->testimonials),
            'bestRating' => '5',
            'worstRating' => '1'
        ]);
        
        $jsonLd->addValue('review', $reviews);
        
        // FAQ Schema
        if (!empty($this->faqs)) {
            $faqJsonLd = \Artesaos\SEOTools\Facades\JsonLdMulti::newJsonLd();
            $faqJsonLd->setType('FAQPage');
            
            $faqElements = [];
            foreach ($this->faqs as $faq) {
                $faqElements[] = [
                    '@type' => 'Question',
                    'name' => $faq['question'],
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $faq['answer']
                    ]
                ];
            }
            
            $faqJsonLd->addValue('mainEntity', $faqElements);
        }
        
        // Organisation
        $orgJsonLd = \Artesaos\SEOTools\Facades\JsonLdMulti::newJsonLd();
        $orgJsonLd->setType('Organization');
        $orgJsonLd->setTitle('Your Business Partner (YBP)');
        $orgJsonLd->setUrl(url('/'));
        $orgJsonLd->addValue('foundingDate', '2025'); // À adapter selon la date de création
        $orgJsonLd->addValue('founder', [
            '@type' => 'Person',
            'name' => 'Maître Lotfi Alimi'
        ]);
        $orgJsonLd->addValue('numberOfEmployees', [
            '@type' => 'QuantitativeValue',
            'minValue' => 10,
            'maxValue' => 50
        ]);
    }
    
    private function getLocaleCode($lang){
        $locales = [
            'fr' => 'fr_TN',
            'ar' => 'ar_TN',
            'en' => 'en_US'
        ];
        
        return $locales[$lang] ?? 'fr_TN';
    }

    private function setServiceSEO($lang, $service){
        if (env('SEO_ACTIVE', 1) == 1) {
            
            // Dictionnaire de titres optimisés par service et par langue
            $serviceTitles = [
                'creation_entreprises' => [
                    'fr' => 'Création d\'Entreprises en Tunisie | YBP - Expert Formation SARL, SA, SUARL',
                    'ar' => 'تأسيس الشركات في تونس | YBP - خبراء تأسيس SARL, SA, SUARL',
                    'en' => 'Company Formation in Tunisia | YBP - Expert SARL, SA, SUARL Setup'
                ],
                'conseil_fiscal_entreprises' => [
                    'fr' => 'Conseil Fiscal Entreprises Tunisie | Optimisation Fiscale & TVA - YBP',
                    'ar' => 'استشارات ضريبية للشركات في تونس | تحسين ضريبي وTVA - YBP',
                    'en' => 'Corporate Tax Consulting Tunisia | Tax Optimization & VAT - YBP'
                ],
                'arbitrage_mediation' => [
                    'fr' => 'Arbitrage & Médiation Commerciale Tunisie | Résolution Conflits - YBP',
                    'ar' => 'تحكيم ووساطة تجارية في تونس | حل النزاعات - YBP',
                    'en' => 'Commercial Arbitration & Mediation Tunisia | Dispute Resolution - YBP'
                ],
                'domiciliation' => [
                    'fr' => 'Domiciliation Entreprise Tunisie | Adresse Professionnelle & Services - YBP',
                    'ar' => 'توطين الشركات في تونس | عنوان مهني وخدمات - YBP',
                    'en' => 'Business Address Tunisia | Professional Domiciliation Services - YBP'
                ],
                'etudes_projets' => [
                    'fr' => 'Études de Projets & Faisabilité Tunisie | Analyse Investissement - YBP',
                    'ar' => 'دراسات المشاريع والجدوى في تونس | تحليل الاستثمار - YBP',
                    'en' => 'Project Studies & Feasibility Tunisia | Investment Analysis - YBP'
                ],
                'conseil_investissement_finance' => [
                    'fr' => 'Conseil Investissement & Finance Tunisie | Leasing, Assurance - YBP',
                    'ar' => 'استشارات الاستثمار والتمويل في تونس | التأجير التمويلي، التأمين - YBP',
                    'en' => 'Investment & Finance Consulting Tunisia | Leasing, Insurance - YBP'
                ],
                'consulting_immobilier' => [
                    'fr' => 'Consulting Immobilier Tunisie | Investissement & Gestion - YBP',
                    'ar' => 'استشارات عقارية في تونس | استثمار وإدارة - YBP',
                    'en' => 'Real Estate Consulting Tunisia | Investment & Management - YBP'
                ],
                'business_pro_services' => [
                    'fr' => 'Services Business VIP Tunisie | Visa, Réservations, Web - YBP',
                    'ar' => 'خدمات أعمال VIP في تونس | تأشيرات، حجوزات، ويب - YBP',
                    'en' => 'VIP Business Services Tunisia | Visa, Bookings, Web - YBP'
                ]
            ];
    
            // Titre optimisé
            $title = $serviceTitles[$service['slug']][$lang] ?? 
                     __($service['name'], [], $lang) . ' | ' . 
                     __('Professional Services Tunisia - Your Business Partner YBP', [], $lang);
            
            SEOTools::setTitle($title . ' | ' . __('Tunisia', [], $lang));
            
            // Descriptions optimisées par service
            $serviceDescriptions = $this->getServiceDescriptions($lang, $service);
            SEOTools::setDescription($serviceDescriptions);
            
            // Mots-clés optimisés par service
            $serviceKeywords = $this->getServiceKeywords($lang, $service);
            SEOTools::metatags()->addKeyword($serviceKeywords);
            
            // H1 SEO optimisé
            SEOTools::metatags()->addMeta('h1', __($service['name'], [], $lang) . ' - ' . __('Expert Professional Services in Tunisia', [], $lang));
            
            // Open Graph optimisé
            SEOTools::opengraph()->setUrl(url()->current());
            SEOTools::opengraph()->addProperty('type', 'service');
            SEOTools::opengraph()->addProperty('locale', $this->getLocaleCode($lang));
            SEOTools::opengraph()->setTitle($title);
            SEOTools::opengraph()->setDescription($serviceDescriptions);
            SEOTools::opengraph()->setSiteName('Your Business Partner (YBP) Tunisia');
            
            // Images spécifiques par service
            $ogImages = $this->getServiceImages($service['slug']);
            foreach ($ogImages as $image) {
                if (is_array($image)) {
                    SEOTools::opengraph()->addImage($image['url'], [
                        'width' => $image['width'] ?? 1200,
                        'height' => $image['height'] ?? 630,
                        'alt' => $image['alt'] ?? $title
                    ]);
                } else {
                    SEOTools::opengraph()->addImage($image);
                }
            }
            
            // Propriétés Open Graph supplémentaires
            SEOTools::opengraph()->addProperty('price:currency', 'TND');
            SEOTools::opengraph()->addProperty('business:contact_data:country_name', 'Tunisia');
            SEOTools::opengraph()->addProperty('business:contact_data:region', 'TN');
                    
            // JSON-LD Structured Data complet
            $this->setEnhancedServiceStructuredData($lang, $service);
            
            // URL Canonical avec paramètres d'UTM
            $canonicalUrl = url()->current();
            SEOTools::setCanonical($canonicalUrl);
            
            // Alternate languages
            $this->setServiceAlternateLinks($lang, $service['slug']);
            
            // Métadonnées robots et techniques
            SEOTools::metatags()->addMeta('robots', 'index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1');
            SEOTools::metatags()->addMeta('revisit-after', '7 days');
            SEOTools::metatags()->addMeta('rating', 'safe for kids');
            
            // Métadonnées spécifiques service
            SEOTools::metatags()->addMeta('service_name', __($service['name'], [], $lang));
            SEOTools::metatags()->addMeta('service_type', 'business_services');
            SEOTools::metatags()->addMeta('service_location', 'Tunisia');
            
            // Article metadata
            $publishDate = '2025-01-01T00:00:00+01:00';
            SEOTools::metatags()->addMeta('article:published_time', $publishDate);
            SEOTools::metatags()->addMeta('article:modified_time', date('c'));
            SEOTools::metatags()->addMeta('article:section', __('Business Services', [], $lang));
            SEOTools::metatags()->addMeta('article:tag', $this->getServiceTagsForMeta($service));
            SEOTools::metatags()->addMeta('article:author', 'Maître Lotfi Alimi');
            
            // Géolocalisation avancée
            $this->setServiceGeoMetadata($lang);
            
            // Métadonnées pour l'audit SEO
            SEOTools::metatags()->addMeta('content-language', $lang);
            SEOTools::metatags()->addMeta('content-type', 'text/html; charset=UTF-8');
            
            // Métadonnées pour les performances
            SEOTools::metatags()->addMeta('viewport', 'width=device-width, initial-scale=1, shrink-to-fit=no');
            SEOTools::metatags()->addMeta('theme-color', '#0d6efd'); // Couleur de votre thème
            
            // Sécurité et vérification
            SEOTools::metatags()->addMeta('x-ua-compatible', 'IE=edge,chrome=1');
            
            // Microdata pour la recherche locale
            SEOTools::metatags()->addMeta('business:hours:time_zone', 'Africa/Tunis');
            SEOTools::metatags()->addMeta('business:contact_data:telephone', '+21624674032');
            SEOTools::metatags()->addMeta('business:contact_data:email', 'ybp.businesstn@gmail.com');
            
        }
    }
    
    private function getServiceDescriptions($lang, $service) {
        $descriptions = [
            'creation_entreprises' => [
                'fr' => 'Expert en création d\'entreprises en Tunisie : SARL, SA, SUARL, EURL. Accompagnement complet pour investisseurs locaux et étrangers. Formalités légales, optimisation fiscale, domiciliation. Contactez YBP pour votre projet.',
                'ar' => 'خبير في تأسيس الشركات في تونس: SARL, SA, SUARL, EURL. دعم كامل للمستثمرين المحليين والأجانب. إجراءات قانونية، تحسين ضريبي، توطين. اتصل بـ YBP لمشروعك.',
                'en' => 'Company formation expert in Tunisia: SARL, SA, SUARL, EURL. Complete support for local and foreign investors. Legal formalities, tax optimization, business address. Contact YBP for your project.'
            ],
            'conseil_fiscal_entreprises' => [
                'fr' => 'Conseil fiscal expert pour entreprises en Tunisie : optimisation TVA, impôt sur les sociétés, transfer pricing, audit fiscal. Réduction légale de votre charge fiscale avec YBP.',
                'ar' => 'استشارات ضريبية متخصصة للشركات في تونس: تحسين TVA، ضريبة الشركات، التسعير التحويلي، التدقيق الضريبي. تخفيض قانوني للعبء الضريبي مع YBP.',
                'en' => 'Expert tax consulting for companies in Tunisia: VAT optimization, corporate tax, transfer pricing, tax audit. Legal reduction of your tax burden with YBP.'
            ],
            'arbitrage_mediation' => [
                'fr' => 'Arbitrage et médiation commerciale en Tunisie : résolution rapide des conflits professionnels. Services confidentiels, économiques et juridiquement contraignants.',
                'ar' => 'تحكيم ووساطة تجارية في تونس: حل سريع للنزاعات المهنية. خدمات سرية، اقتصادية وملزمة قانونياً.',
                'en' => 'Commercial arbitration and mediation in Tunisia: quick resolution of professional conflicts. Confidential, economical and legally binding services.'
            ],
            'domiciliation' => [
                'fr' => 'Domiciliation d\'entreprise en Tunisie : adresse professionnelle prestigieuse à Tunis, gestion courrier, salles de réunion. Solution flexible et économique.',
                'ar' => 'توطين الشركات في تونس: عنوان مهني مميز في تونس، إدارة البريد، قاعات اجتماعات. حل مرن واقتصادي.',
                'en' => 'Business address services in Tunisia: prestigious professional address in Tunis, mail management, meeting rooms. Flexible and economical solution.'
            ],
            'etudes_projets' => [
                'fr' => 'Études de projets et faisabilité en Tunisie : analyse marché, projections financières, évaluation risques. Expertise sectorielle pour investissements sûrs.',
                'ar' => 'دراسات المشاريع والجدوى في تونس: تحليل السوق، توقعات مالية، تقييم المخاطر. خبرة قطاعية لاستثمارات آمنة.',
                'en' => 'Project studies and feasibility in Tunisia: market analysis, financial projections, risk assessment. Sector expertise for safe investments.'
            ],
            'conseil_investissement_finance' => [
                'fr' => 'Conseil en investissement et finance en Tunisie : leasing équipement, assurance entreprise, financement bancaire. Solutions sur mesure pour votre croissance.',
                'ar' => 'استشارات الاستثمار والتمويل في تونس: تأجير تمويلي للمعدات، تأمين الشركات، تمويل بنكي. حلول مخصصة لنموك.',
                'en' => 'Investment and finance consulting in Tunisia: equipment leasing, corporate insurance, bank financing. Tailored solutions for your growth.'
            ],
            'consulting_immobilier' => [
                'fr' => 'Consulting immobilier en Tunisie : investissement, gestion, transaction. Expertise marché tunisien pour particuliers et professionnels.',
                'ar' => 'استشارات عقارية في تونس: استثمار، إدارة، معاملات. خبرة في السوق التونسية للأفراد والمحترفين.',
                'en' => 'Real estate consulting in Tunisia: investment, management, transactions. Tunisian market expertise for individuals and professionals.'
            ],
            'business_pro_services' => [
                'fr' => 'Services Business VIP en Tunisie : visa, réservations vol/hôtel, location voiture, création site web, organisation événements. Solution tout-en-un.',
                'ar' => 'خدمات أعمال VIP في تونس: تأشيرات، حجوزات طيران/فنادق، تأجير سيارات، إنشاء مواقع ويب، تنظيم فعاليات. حل شامل.',
                'en' => 'VIP Business Services in Tunisia: visa, flight/hotel bookings, car rental, website creation, event organization. All-in-one solution.'
            ]
        ];
        
        return $descriptions[$service['slug']][$lang] ?? 
               __($service['description'], [], $lang) . ' ' . 
               __('Professional services in Tunisia by YBP. Contact us for expert assistance.', [], $lang);
    }
    
    private function getServiceKeywords($lang, $service) {
        $baseKeywords = [];
        
        // Mots-clés spécifiques par service
        $serviceKeywords = [
            'creation_entreprises' => [
                'fr' => ['création SARL Tunisie', 'formation SA Tunisie', 'entreprise étrangère Tunisie', 'formalités création société', 'statuts juridiques Tunisie'],
                'ar' => ['تأسيس SARL تونس', 'تكوين SA تونس', 'شركة أجنبية تونس', 'إجراءات تأسيس شركة', 'أنظمة قانونية تونس'],
                'en' => ['SARL formation Tunisia', 'SA setup Tunisia', 'foreign company Tunisia', 'company registration formalities', 'legal statutes Tunisia']
            ],
            'conseil_fiscal_entreprises' => [
                'fr' => ['optimisation TVA Tunisie', 'impôt sociétés Tunisie', 'déclaration fiscale', 'audit fiscal', 'transfer pricing Tunisie'],
                'ar' => ['تحسين TVA تونس', 'ضريبة الشركات تونس', 'إقرار ضريبي', 'تدقيق ضريبي', 'تسعير تحويلي تونس'],
                'en' => ['VAT optimization Tunisia', 'corporate tax Tunisia', 'tax return', 'tax audit', 'transfer pricing Tunisia']
            ],
            'arbitrage_mediation' => [
                'fr' => ['conflit commercial Tunisie', 'résolution litige', 'médiateur professionnel', 'sentence arbitrale', 'conciliation'],
                'ar' => ['نزاع تجاري تونس', 'حول نزاع', 'وسيط محترف', 'حكم تحكيمي', 'توفيق'],
                'en' => ['commercial conflict Tunisia', 'dispute resolution', 'professional mediator', 'arbitral award', 'conciliation']
            ],
            'domiciliation' => [
                'fr' => ['adresse légale Tunis', 'bureau virtuel Tunisie', 'gestion courrier entreprise', 'salle réunion Tunis', 'centre d\'affaires'],
                'ar' => ['عنوان قانوني تونس', 'مكتب افتراضي تونس', 'إدارة بريد الشركات', 'قاعة اجتماعات تونس', 'مركز أعمال'],
                'en' => ['legal address Tunis', 'virtual office Tunisia', 'business mail management', 'meeting room Tunis', 'business center']
            ],
            'etudes_projets' => [
                'fr' => ['étude marché Tunisie', 'business plan', 'analyse financière', 'évaluation risque', 'faisabilité projet'],
                'ar' => ['دراسة السوق تونس', 'خطة عمل', 'تحليل مالي', 'تقييم مخاطر', 'جدوى مشروع'],
                'en' => ['market study Tunisia', 'business plan', 'financial analysis', 'risk assessment', 'project feasibility']
            ],
            'conseil_investissement_finance' => [
                'fr' => ['leasing matériel Tunisie', 'financement bancaire', 'assurance professionnelle', 'capital investissement', 'crédit entreprise'],
                'ar' => ['تأجير تمويلي للمعدات تونس', 'تمويل بنكي', 'تأمين مهني', 'رأس مال استثماري', 'قرض شركات'],
                'en' => ['equipment leasing Tunisia', 'bank financing', 'professional insurance', 'investment capital', 'business loan']
            ],
            'consulting_immobilier' => [
                'fr' => ['investissement immobilier Tunisie', 'transaction immobilière', 'gestion propriété', 'marché immobilier Tunis', 'due diligence'],
                'ar' => ['استثمار عقاري تونس', 'معاملة عقارية', 'إدارة عقار', 'سوق عقارات تونس', 'العناية الواجبة'],
                'en' => ['real estate investment Tunisia', 'property transaction', 'property management', 'real estate market Tunis', 'due diligence']
            ],
            'business_pro_services' => [
                'fr' => ['visa Tunisie', 'réservation hôtel Tunis', 'location voiture chauffeur', 'création site web Tunisie', 'organisation séminaire'],
                'ar' => ['تأشيرة تونس', 'حجز فندق تونس', 'تأجير سيارة مع سائق', 'إنشاء موقع ويب تونس', 'تنظيم ندوة'],
                'en' => ['visa Tunisia', 'hotel booking Tunis', 'car rental with driver', 'website creation Tunisia', 'seminar organization']
            ]
        ];
        
        // Mots-clés de base
        $baseKeywords[] = __($service['name'], [], $lang) . ' Tunisie';
        $baseKeywords[] = __($service['name'], [], $lang) . ' Tunisia';
        $baseKeywords[] = 'YBP ' . __($service['name'], [], $lang);
        $baseKeywords[] = __('business services Tunisia', [], $lang);
        $baseKeywords[] = __('professional services Tunisia', [], $lang);
        $baseKeywords[] = __('Tunisia business solutions', [], $lang);
        
        // Mots-clés spécifiques au service
        if (isset($serviceKeywords[$service['slug']][$lang])) {
            $baseKeywords = array_merge($baseKeywords, $serviceKeywords[$service['slug']][$lang]);
        }
        
        // Tags du service
        if (isset($service['tags']) && is_array($service['tags'])) {
            foreach ($service['tags'] as $tag) {
                $baseKeywords[] = __($tag, [], $lang) . ' Tunisia';
                $baseKeywords[] = __($tag, [], $lang) . ' Tunisie';
            }
        }
        
        // Mots-clés de localisation
        $baseKeywords[] = __('Tunis business services', [], $lang);
        $baseKeywords[] = __('Tunis professional services', [], $lang);
        
        return array_unique($baseKeywords);
    }
    
    private function getServiceImages($serviceSlug) {
        $images = [
            'creation_entreprises' => [
                ['url' => asset('welcome/assets/img/ybp/1.jpeg'), 'width' => 1200, 'height' => 630, 'alt' => 'Création entreprise Tunisie']
            ],
            'conseil_fiscal_entreprises' => [
                ['url' => asset('welcome/assets/img/ybp/1.jpeg'), 'width' => 1200, 'height' => 630, 'alt' => 'Conseil fiscal Tunisie']
            ],
            'arbitrage_mediation' => [
                ['url' => asset('welcome/assets/img/ybp/1.jpeg'), 'width' => 1200, 'height' => 630, 'alt' => 'Arbitrage commercial Tunisie']
            ],
            'domiciliation' => [
                ['url' => asset('welcome/assets/img/services/office-space.jpg'), 'width' => 1200, 'height' => 630, 'alt' => 'Domiciliation entreprise Tunis']
            ],
            'etudes_projets' => [
                ['url' => asset('welcome/assets/img/ybp/1.jpeg'), 'width' => 1200, 'height' => 630, 'alt' => 'Étude projet Tunisie']
            ],
            'conseil_investissement_finance' => [
                ['url' => asset('welcome/assets/img/ybp/1.jpeg'), 'width' => 1200, 'height' => 630, 'alt' => 'Conseil investissement Tunisie']
            ],
            'consulting_immobilier' => [
                ['url' => asset('welcome/assets/img/ybp/1.jpeg'), 'width' => 1200, 'height' => 630, 'alt' => 'Consulting immobilier Tunisie']
            ],
            'business_pro_services' => [
                ['url' => asset('welcome/assets/img/ybp/1.jpeg'), 'width' => 1200, 'height' => 630, 'alt' => 'Services VIP Tunisie']
            ]
        ];
        
        return $images[$serviceSlug] ?? [
            ['url' => asset('welcome/assets/img/ybp/1.jpeg'), 'width' => 1200, 'height' => 630]
        ];
    }
    
    private function getServiceTagsForMeta($service) {
        $tags = [];
        
        if (isset($service['tags']) && is_array($service['tags'])) {
            $tags = array_slice($service['tags'], 0, 5);
        }
        
        // Ajouter des tags généraux
        $tags[] = 'Tunisia';
        $tags[] = 'Business Services';
        $tags[] = 'Professional Services';
        
        return implode(', ', $tags);
    }
    
    private function setServiceGeoMetadata($lang) {
        SEOTools::metatags()->addMeta('geo.region', 'TN');
        SEOTools::metatags()->addMeta('geo.placename', 'Tunis');
        SEOTools::metatags()->addMeta('geo.position', '36.81777971732256;10.17965708465764');
        SEOTools::metatags()->addMeta('ICBM', '36.81777971732256, 10.17965708465764');
        
        // Zones spécifiques en Tunisie
        SEOTools::metatags()->addMeta('business:contact_data:locality', 'Tunis');
        SEOTools::metatags()->addMeta('business:contact_data:region', 'Tunis');
        SEOTools::metatags()->addMeta('business:contact_data:postal_code', '1002');
        
        // Heure locale
        SEOTools::metatags()->addMeta('timezone', 'Africa/Tunis');
        SEOTools::metatags()->addMeta('currency', 'TND');
    }
    
    private function setEnhancedServiceStructuredData($lang, $service) {
        // Données structurées principales
        $serviceData = [
            '@context' => 'https://schema.org',
            '@type' => 'ProfessionalService',
            '@id' => url()->current() . '#service',
            'name' => __($service['name'], [], $lang),
            'description' => __($service['description'], [], $lang),
            'provider' => [
                '@type' => 'Organization',
                '@id' => url('/') . '#organization',
                'name' => 'Your Business Partner (YBP)',
                'url' => url('/'),
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('welcome/assets/img/ybp/1.jpeg')
                ],
                'contactPoint' => [
                    '@type' => 'ContactPoint',
                    'telephone' => '+216-24674032',
                    'contactType' => 'customer service',
                    'email' => 'ybp.businesstn@gmail.com',
                    'availableLanguage' => ['French', 'Arabic', 'English']
                ]
            ],
            'areaServed' => [
                '@type' => 'Country',
                'name' => 'Tunisia',
                'sameAs' => 'https://en.wikipedia.org/wiki/Tunisia'
            ],
            'serviceType' => __($service['name'], [], $lang),
            'url' => url()->current(),
            'image' => $this->getServiceImages($service['slug'])[0]['url'] ?? asset('welcome/assets/img/ybp/1.jpeg'),
            'offers' => [
                '@type' => 'Offer',
                'priceCurrency' => 'TND',
                'availability' => 'https://schema.org/InStock',
                'availableDeliveryMethod' => 'https://schema.org/OnSitePickup',
                'seller' => [
                    '@type' => 'Organization',
                    'name' => 'Your Business Partner (YBP)'
                ]
            ],
            'aggregateRating' => [
                '@type' => 'AggregateRating',
                'ratingValue' => '4.8',
                'reviewCount' => '47',
                'bestRating' => '5',
                'worstRating' => '1'
            ]
        ];
        
        // Sous-services
        if (isset($service['items']) && is_array($service['items'])) {
            $subServices = [];
            foreach ($service['items'] as $index => $item) {
                $subServices[] = [
                    '@type' => 'Service',
                    'position' => $index + 1,
                    'name' => __($item['title'], [], $lang),
                    'description' => __($item['description'], [], $lang),
                    'offers' => [
                        '@type' => 'Offer',
                        'availability' => 'https://schema.org/InStock'
                    ]
                ];
            }
            $serviceData['hasPart'] = $subServices;
        }
        
        // Avantages
        if (isset($service['advantages']) && is_array($service['advantages'])) {
            $serviceData['additionalProperty'] = [];
            foreach ($service['advantages'] as $advantage) {
                $serviceData['additionalProperty'][] = [
                    '@type' => 'PropertyValue',
                    'name' => 'Advantage',
                    'value' => __($advantage, [], $lang)
                ];
            }
        }
        
        // Breadcrumb détaillé
        $breadcrumbData = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => __('Home', [], $lang),
                    'item' => url('/')
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => __('Services', [], $lang),
                    'item' => url(route($lang . '.welcome') . '#services')
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 3,
                    'name' => __($service['name'], [], $lang),
                    'item' => url()->current()
                ]
            ]
        ];
        
        // FAQ spécifique au service
        $faqData = $this->getEnhancedServiceFAQData($lang, $service);
        
        // Organisation
        $organizationData = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            '@id' => url('/') . '#organization',
            'name' => 'Your Business Partner (YBP)',
            'url' => url('/'),
            'logo' => asset('welcome/assets/img/ybp/1.jpeg'),
            'description' => __('Professional business services company in Tunisia', [], $lang),
            'foundingDate' => '2008',
            'founder' => [
                '@type' => 'Person',
                'name' => 'Maître Lotfi Alimi',
                'jobTitle' => 'Manager'
            ],
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => '5 -ème étage bureau 2 , immeuble ALQUDS : 85-87 Rue de La Palestine',
                'addressLocality' => 'Tunis',
                'addressRegion' => 'Tunis',
                'postalCode' => '1002',
                'addressCountry' => 'TN'
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => '+216-24674032',
                'contactType' => 'customer service',
                'areaServed' => 'TN',
                'availableLanguage' => ['French', 'Arabic', 'English']
            ],
            'sameAs' => [
                'https://www.facebook.com/Cabinetlotfialimijurifisc',
                'https://tn.linkedin.com/in/lotfi-alimi-b23a59130',
                'https://www.tiktok.com/@yourbusinesspartnertn'
            ]
        ];
        
        // Combiner toutes les données structurées
        $allStructuredData = [
            $serviceData,
            $breadcrumbData,
            $organizationData
        ];
        
        if (!empty($faqData)) {
            $allStructuredData[] = $faqData;
        }
        
        // Ajouter les données structurées
        SEOTools::jsonLd()->addValue('@graph', $allStructuredData);
    }
    
    private function getEnhancedServiceFAQData($lang, $service) {
        $faqMap = [
            'creation_entreprises' => [
                [
                    'question' => __('How much does it cost to create a company in Tunisia?', [], $lang),
                    'answer' => __('The cost varies between 1,500 TND and 5,000 TND depending on the type of company (SARL, SA, SUARL), legal fees, and additional services required.', [], $lang)
                ],
                [
                    'question' => __('What is the minimum capital required for a SARL in Tunisia?', [], $lang),
                    'answer' => __('For a SARL (Limited Liability Company), the minimum capital is 1,000 TND, which must be deposited in a bank account before registration.', [], $lang)
                ],
                [
                    'question' => __('Can a foreigner create a company in Tunisia?', [], $lang),
                    'answer' => __('Yes, foreigners can create companies in Tunisia. YBP assists with all necessary procedures, including obtaining foreign investment approvals if required.', [], $lang)
                ],
                [
                    'question' => __('How long does the registration process take?', [], $lang),
                    'answer' => __('The complete registration process typically takes 2-4 weeks, including obtaining the company registration certificate (Extrait RNE) and tax identification.', [], $lang)
                ]
            ],
            'conseil_fiscal_entreprises' => [
                [
                    'question' => __('What are the corporate tax rates in Tunisia?', [], $lang),
                    'answer' => __('Corporate tax rates vary between 15% and 35% depending on the sector and annual turnover. Export-oriented companies benefit from reduced rates.', [], $lang)
                ],
                [
                    'question' => __('Do you help with VAT registration?', [], $lang),
                    'answer' => __('Yes, we handle complete VAT registration, including submission of required documents, obtaining the VAT number, and setting up monthly/quarterly declaration systems.', [], $lang)
                ],
                [
                    'question' => __('What tax incentives are available for new companies?', [], $lang),
                    'answer' => __('New companies can benefit from tax exemptions for the first 5 years in certain sectors, reduced rates for export activities, and investment incentives in priority zones.', [], $lang)
                ]
            ],
            'arbitrage_mediation' => [
                [
                    'question' => __('What types of conflicts can be resolved through arbitration?', [], $lang),
                    'answer' => __('Commercial disputes, partnership conflicts, contractual disagreements, intellectual property disputes, and international trade conflicts can be resolved through arbitration.', [], $lang)
                ],
                [
                    'question' => __('Is an arbitral award enforceable in Tunisia?', [], $lang),
                    'answer' => __('Yes, arbitral awards are legally binding and enforceable in Tunisia under the Arbitration Code, similar to court judgments.', [], $lang)
                ],
                [
                    'question' => __('How long does an arbitration procedure take?', [], $lang),
                    'answer' => __('Arbitration procedures typically take 3-6 months, significantly faster than traditional court proceedings which can take 1-3 years.', [], $lang)
                ]
            ],
            'domiciliation' => [
                [
                    'question' => __('What services are included in the domiciliation package?', [], $lang),
                    'answer' => __('Our domiciliation service includes a professional business address, mail reception and forwarding, call answering services, and access to meeting rooms.', [], $lang)
                ],
                [
                    'question' => __('Can I use the address for official company registration?', [], $lang),
                    'answer' => __('Yes, our addresses are fully legal for company registration with the Trade Register and can be used as your official company headquarters.', [], $lang)
                ],
                [
                    'question' => __('Do you provide meeting room access?', [], $lang),
                    'answer' => __('Yes, our premium packages include access to fully equipped meeting rooms with video conferencing facilities, projectors, and high-speed internet.', [], $lang)
                ]
            ],
            'etudes_projets' => [
                [
                    'question' => __('What does a feasibility study include?', [], $lang),
                    'answer' => __('Our feasibility studies include market analysis, technical assessment, financial projections, risk analysis, and regulatory compliance review.', [], $lang)
                ],
                [
                    'question' => __('How long does a project study take?', [], $lang),
                    'answer' => __('Depending on complexity, project studies typically take 2-8 weeks, including field research, data analysis, and report preparation.', [], $lang)
                ],
                [
                    'question' => __('Do you help with business plan preparation?', [], $lang),
                    'answer' => __('Yes, we provide complete business plan development services including financial modeling, market strategy, and investment pitch preparation.', [], $lang)
                ]
            ],
            'conseil_investissement_finance' => [
                [
                    'question' => __('What financing options are available for businesses in Tunisia?', [], $lang),
                    'answer' => __('Businesses can access bank loans, leasing arrangements, venture capital, government grants, and foreign investment funds through our network.', [], $lang)
                ],
                [
                    'question' => __('Do you offer equipment leasing services?', [], $lang),
                    'answer' => __('Yes, we provide complete equipment leasing solutions for vehicles, machinery, IT equipment, and industrial machinery with flexible payment terms.', [], $lang)
                ],
                [
                    'question' => __('What insurance coverage do businesses need in Tunisia?', [], $lang),
                    'answer' => __('Essential insurance includes professional liability, property insurance, business interruption, employee benefits, and vehicle insurance for company cars.', [], $lang)
                ]
            ],
            'consulting_immobilier' => [
                [
                    'question' => __('What areas of Tunisia do you cover for real estate consulting?', [], $lang),
                    'answer' => __('We cover all major regions including Tunis, Sousse, Hammamet, Nabeul, Monastir, and emerging investment zones across Tunisia.', [], $lang)
                ],
                [
                    'question' => __('Do you assist with property transactions for foreigners?', [], $lang),
                    'answer' => __('Yes, we provide complete support for foreign investors including legal due diligence, transaction management, and compliance with Tunisian property laws.', [], $lang)
                ],
                [
                    'question' => __('What are the current real estate investment opportunities?', [], $lang),
                    'answer' => __('Current opportunities include residential developments in coastal areas, commercial spaces in Tunis business districts, and tourism projects in strategic locations.', [], $lang)
                ]
            ],
            'business_pro_services' => [
                [
                    'question' => __('How quickly can you arrange visa services?', [], $lang),
                    'answer' => __('Standard visa processing takes 5-10 working days. We also offer expedited services for urgent travel needs.', [], $lang)
                ],
                [
                    'question' => __('Do you provide airport VIP services?', [], $lang),
                    'answer' => __('Yes, our VIP services include fast-track immigration, luggage handling, lounge access, and chauffeur services at Tunis-Carthage International Airport.', [], $lang)
                ],
                [
                    'question' => __('Can you help open a foreign currency bank account?', [], $lang),
                    'answer' => __('Yes, we assist with opening foreign currency accounts (EUR, USD) in Tunisian banks for both individuals and companies.', [], $lang)
                ],
                [
                    'question' => __('Do you offer web development services?', [], $lang),
                    'answer' => __('Yes, we provide complete web solutions including website design, e-commerce development, hosting, and ongoing maintenance services.', [], $lang)
                ]
            ]
        ];
        
        if (isset($faqMap[$service['slug']])) {
            $faqItems = [];
            foreach ($faqMap[$service['slug']] as $index => $faq) {
                $faqItems[] = [
                    '@type' => 'Question',
                    'name' => $faq['question'],
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $faq['answer']
                    ]
                ];
            }
            
            return [
                '@context' => 'https://schema.org',
                '@type' => 'FAQPage',
                'mainEntity' => $faqItems
            ];
        }
        
        return null;
    }
    
    private function setServiceAlternateLinks($lang, $slug){
        $locales = ['fr', 'ar', 'en'];
        
        foreach ($locales as $locale) {
            if ($locale !== $lang) {
                $url = route($locale . '.welcome.service', $slug);
                SEOTools::metatags()->addAlternateLanguage($locale, $url);
            }
        }
        
        // Ajouter x-default
        SEOTools::metatags()->addAlternateLanguage('x-default', route('fr.welcome.service', $slug));
    }
    
}
