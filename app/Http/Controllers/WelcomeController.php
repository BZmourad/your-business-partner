<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Contact;
use Artesaos\SEOTools\Facades\SEOTools;

class WelcomeController extends Controller
{
    protected $services = [
        [
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
                ['icon' => 'fas fa-map-pin', 'name' => 'Lac Zone'],
                ['icon' => 'fas fa-map-pin', 'name' => 'Berges du Lac'],
                ['icon' => 'fas fa-building', 'name' => 'Premium Addresses'],
                ['icon' => 'fas fa-envelope', 'name' => 'Mail Services']
            ],
            'tags' => ['Domiciliation', 'Virtual Office', 'Business Address', 'Mail Handling', 'Meeting Rooms', 'Call Services']
        ],
        [
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
            
            // Titre SEO
            SEOTools::setTitle(__('Your Business Partner (YBP) - Complete Services for Businesses in Tunisia', [], $lang));
            
            // Description SEO
            SEOTools::setDescription(__('YBP Tunisia: Company creation, tax consulting, arbitration, domiciliation, project studies, finance, real estate consulting and professional business services. Your partner for success in Tunisia.', [], $lang));
            
            // Mots-clés avec traduction
            $keywords = [
                __('company formation Tunisia', [], $lang),
                __('tax consulting Tunisia', [], $lang),
                __('commercial arbitration Tunisia', [], $lang),
                __('business domiciliation Tunisia', [], $lang),
                __('project studies Tunisia', [], $lang),
                __('business financing Tunisia', [], $lang),
                __('real estate consulting Tunisia', [], $lang),
                __('business services Tunisia', [], $lang),
                __('Your Business Partner YBP', [], $lang),
                __('investment Tunisia', [], $lang),
                __('visa Tunisia', [], $lang),
                __('leasing Tunisia', [], $lang),
                __('corporate insurance Tunisia', [], $lang),
                __('bank account opening Tunisia', [], $lang)
            ];
            
            SEOTools::metatags()->addKeyword($keywords);
            
            // Open Graph
            SEOTools::opengraph()->setUrl(url()->current());
            SEOTools::opengraph()->addProperty('type', 'website');
            SEOTools::opengraph()->addProperty('locale', $this->getLocaleCode($lang));
            SEOTools::opengraph()->setTitle(__('YBP - Your Business Partner in Tunisia', [], $lang));
            SEOTools::opengraph()->setDescription(__('Complete business services: company creation, taxation, arbitration, domiciliation, studies, finance, real estate and professional services.', [], $lang));
            
            // Images pour Open Graph
            $images = [
                asset('welcome/assets/img/logo/logo-ybp.png'),
                asset('welcome/assets/img/about/about-img3.jpg'),
                asset('welcome/assets/img/hero/hero-bg.jpg')
            ];
            
            foreach ($images as $image) {
                SEOTools::opengraph()->addImage($image);
            }
            
            // Twitter Card
            SEOTools::twitter()->setSite('@YBP_Tunisie');
            SEOTools::twitter()->setTitle(__('Your Business Partner - Complete Services in Tunisia', [], $lang));
            SEOTools::twitter()->setDescription(__('8 essential services for your business in Tunisia: creation, taxation, arbitration, domiciliation, studies, finance, real estate, professional services.', [], $lang));
            SEOTools::twitter()->setImage(asset('welcome/assets/img/logo/logo-ybp.png'));
            
            // JSON-LD Structured Data
            $this->setStructuredData($lang);
            
            // Canonical URL
            SEOTools::setCanonical(url()->current());
            
            // Alternate languages
            SEOTools::metatags()->addAlternateLanguage('fr', url('/'));
            SEOTools::metatags()->addAlternateLanguage('ar', url('/ar'));
            SEOTools::metatags()->addAlternateLanguage('en', url('/en'));
            
            // Robots
            SEOTools::metatags()->addMeta('robots', 'index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1');
            
            // Viewport
            SEOTools::metatags()->addMeta('viewport', 'width=device-width, initial-scale=1');
            
        }
    }

    private function setStructuredData($lang){
        // Services pour les données structurées
        $servicesArray = [];
        foreach ($this->services as $service) {
            $servicesArray[] = [
                '@type' => 'Service',
                'name' => __($service['name'], [], $lang),
                'description' => __($service['description'], [], $lang),
                'url' => url(route($lang . '.welcome.service', $service['slug']))
            ];
        }
        
        // Données structurées principales
        SEOTools::jsonLd()->setType('ProfessionalService');
        SEOTools::jsonLd()->setTitle(__('Your Business Partner (YBP) - Professional Services in Tunisia', [], $lang));
        SEOTools::jsonLd()->setDescription(__('Professional services for businesses in Tunisia: company creation, tax consulting, arbitration, domiciliation, project studies, investment consulting, real estate consulting and business services.', [], $lang));
        SEOTools::jsonLd()->addValue('areaServed', 'TN');
        
        // Données structurées LocalBusiness
        $jsonLd = \Artesaos\SEOTools\Facades\JsonLdMulti::newJsonLd();
        $jsonLd->setType('LocalBusiness');
        $jsonLd->setName('Your Business Partner (YBP)');
        $jsonLd->setDescription(__('Professional services for businesses in Tunisia', [], $lang));
        $jsonLd->addValue('telephone', '+216 24674032');
        $jsonLd->addValue('email', 'contact@ybp-tunisie.com');
        
        // Adresse
        $jsonLd->addValue('address', [
            '@type' => 'PostalAddress',
            'streetAddress' => __('Rue de la Bourse', [], $lang),
            'addressLocality' => 'Tunis',
            'addressRegion' => 'Tunis',
            'postalCode' => '1000',
            'addressCountry' => 'TN'
        ]);
        
        // Horaires d'ouverture
        $jsonLd->addValue('openingHoursSpecification', [
            [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                'opens' => '08:00',
                'closes' => '18:00'
            ]
        ]);
        
        // Réseaux sociaux
        $jsonLd->addValue('sameAs', [
            'https://facebook.com/ybptunisie',
            'https://linkedin.com/company/ybp-tunisie',
            'https://twitter.com/YBP_Tunisie'
        ]);
        
        // Catalogue de services
        $jsonLd->addValue('hasOfferCatalog', [
            '@type' => 'OfferCatalog',
            'name' => __('YBP Services', [], $lang),
            'description' => __('Complete business services in Tunisia', [], $lang),
            'itemListElement' => $servicesArray
        ]);
        
        // Évaluation
        $jsonLd->addValue('aggregateRating', [
            '@type' => 'AggregateRating',
            'ratingValue' => '4.9',
            'reviewCount' => '127',
            'bestRating' => '5',
            'worstRating' => '1'
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
            
            // Titre SEO pour le service
            $serviceTitle = __($service['name'], [], $lang) . ' - ' . __('Your Business Partner (YBP)', [], $lang);
            SEOTools::setTitle($serviceTitle);
            
            // Description SEO pour le service
            $serviceDescription = __($service['description'], [], $lang) . ' ' . 
                                __('Professional services in Tunisia by YBP. Expert guidance and comprehensive solutions for your business needs.', [], $lang);
            SEOTools::setDescription($serviceDescription);
            
            // Mots-clés spécifiques au service
            $serviceKeywords = [
                __($service['name'], [], $lang) . ' Tunisia',
                __($service['name'], [], $lang) . ' Tunisie',
                __('YBP', [], $lang) . ' ' . __($service['name'], [], $lang),
                __('business services Tunisia', [], $lang),
                __('professional services Tunisia', [], $lang)
            ];
            
            // Ajouter les tags du service
            if (isset($service['tags']) && is_array($service['tags'])) {
                foreach ($service['tags'] as $tag) {
                    $serviceKeywords[] = __($tag, [], $lang) . ' Tunisia';
                }
            }
            
            SEOTools::metatags()->addKeyword($serviceKeywords);
            
            // Open Graph
            SEOTools::opengraph()->setUrl(url()->current());
            SEOTools::opengraph()->addProperty('type', 'article');
            SEOTools::opengraph()->addProperty('locale', $this->getLocaleCode($lang));
            SEOTools::opengraph()->setTitle($serviceTitle);
            SEOTools::opengraph()->setDescription($serviceDescription);
            SEOTools::opengraph()->setSiteName('Your Business Partner (YBP)');
            
            // Images Open Graph pour les services
            $ogImages = [
                asset('welcome/assets/img/services/services-details.jpg'),
                asset('welcome/assets/img/logo/logo-ybp.png')
            ];
            
            foreach ($ogImages as $image) {
                SEOTools::opengraph()->addImage($image);
            }
            
            // Twitter Card
            SEOTools::twitter()->setCard('summary_large_image');
            SEOTools::twitter()->setSite('@YBP_Tunisie');
            SEOTools::twitter()->setTitle(__($service['name'], [], $lang) . ' - YBP Tunisia');
            SEOTools::twitter()->setDescription(substr($serviceDescription, 0, 200));
            SEOTools::twitter()->setImage(asset('welcome/assets/img/services/services-details.jpg'));
            
            // JSON-LD Structured Data pour le service
            $this->setServiceStructuredData($lang, $service);
            
            // URL Canonical
            SEOTools::setCanonical(url()->current());
            
            // Alternate languages pour le service
            $this->setServiceAlternateLinks($lang, $service['slug']);
            
            // Robots
            SEOTools::metatags()->addMeta('robots', 'index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1');
            
            // Métadonnées supplémentaires
            SEOTools::metatags()->addMeta('article:published_time', '2024-01-01T00:00:00+01:00');
            SEOTools::metatags()->addMeta('article:modified_time', date('c'));
            SEOTools::metatags()->addMeta('article:section', __('Business Services', [], $lang));
            SEOTools::metatags()->addMeta('article:tag', __($service['name'], [], $lang));
            
            // Auteur
            SEOTools::metatags()->addMeta('author', 'Your Business Partner (YBP)');
            
            // Géolocalisation
            SEOTools::metatags()->addMeta('geo.region', 'TN');
            SEOTools::metatags()->addMeta('geo.placename', 'Tunis');
            
        }
    }

    private function setServiceStructuredData($lang, $service){
        // Service principal
        $serviceData = [
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => __($service['name'], [], $lang),
            'description' => __($service['description'], [], $lang),
            'provider' => [
                '@type' => 'Organization',
                'name' => 'Your Business Partner (YBP)',
                'url' => url('/'),
                'logo' => asset('welcome/assets/img/logo/logo-ybp.png')
            ],
            'areaServed' => [
                '@type' => 'Country',
                'name' => 'Tunisia'
            ],
            'serviceType' => __($service['name'], [], $lang),
            'url' => url()->current(),
            'offers' => [
                '@type' => 'Offer',
                'priceCurrency' => 'TND',
                'availability' => 'https://schema.org/InStock'
            ]
        ];
        
        // Ajouter les sous-services
        if (isset($service['items']) && is_array($service['items'])) {
            $subServices = [];
            foreach ($service['items'] as $item) {
                $subServices[] = [
                    '@type' => 'Service',
                    'name' => __($item['title'], [], $lang),
                    'description' => __($item['description'], [], $lang)
                ];
            }
            $serviceData['hasPart'] = $subServices;
        }
        
        // Breadcrumb
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
        
        // FAQ si disponible
        $faqData = $this->getServiceFAQData($lang, $service);
        
        // Combiner toutes les données structurées
        $allStructuredData = [$serviceData, $breadcrumbData];
        if (!empty($faqData)) {
            $allStructuredData[] = $faqData;
        }
        
        SEOTools::jsonLd()->addValue('@graph', $allStructuredData);
    }

    private function getServiceFAQData($lang, $service){
        // Exemple de FAQ pour chaque service (vous pouvez personnaliser selon le service)
        $faqMap = [
            'creation_entreprises' => [
                [
                    'question' => __('How long does it take to create a company in Tunisia?', [], $lang),
                    'answer' => __('The company creation process typically takes 2-4 weeks, depending on the company type and required approvals.', [], $lang)
                ],
                [
                    'question' => __('What documents are needed for company creation?', [], $lang),
                    'answer' => __('Required documents include identification documents, proof of address, company statutes, and specific forms depending on the company type.', [], $lang)
                ]
            ],
            'conseil_fiscal_entreprises' => [
                [
                    'question' => __('What tax consulting services do you offer?', [], $lang),
                    'answer' => __('We provide tax optimization strategies, VAT compliance, corporate tax planning, and tax audit support.', [], $lang)
                ]
            ],
            // Ajouter d'autres services ici...
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
    }
    
}
