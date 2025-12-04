<?php

namespace Database\Seeders;

use App\Models\Document\DocumentName;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    public function run()
    {
        $documents = [
            // Documents d'identité
            ["name" => "بطاقة التعريف الوطنية | Carte d'identité nationale [CIN]"],
            ["name" => "جواز السفر | Passeport"],
            ["name" => "تصريح إقامة | Permis de séjour"],
            ["name" => "البطاقة المهنية | Carte professionnelle"],
            // Documents d'état civil
            ["name" => "مضمون ولادة | Extrait de naissance"],
            ["name" => "مضمون زواج | Extrait d'acte de mariage"],
            ["name" => "مضمون وفاة | Extrait d'acte de décès"],
            ["name" => "شهادة طلاق | Certificat de divorce"],
            ["name" => "شهادة إقامة | Certificat de résidence"],
            ["name" => "شهادة العزوبة | Certificat de célibat"],
            // Documents fiscaux
            ["name" => "بطاقة تعريفية ضريبية | Carte d'identité fiscale"],
            ["name" => "شهادة التسجيل في سجل الأجراء | Certificat d'inscription au registre des employeurs"],
            ["name" => "شهادة التسجيل في الضمان الاجتماعي | Certificat de sécurité sociale"],
            ["name" => "إقرار ضريبي | Déclaration fiscale"],
            ["name" => "شهادة الأداء | Certificat de paiement"],
            ["name" => "شهادة التسجيل في الرسم على القيمة المضافة | Certificat d'enregistrement à la TVA"],
            ["name" => "دفتر المحاسبة | Livre de comptabilité"],
            ["name" => "كشف الحساب البنكي | Relevé bancaire"],
            ["name" => "فاتورة | Facture"],
            ["name" => "عقد عمل | Contrat de travail"],
            ["name" => "كشوف الرواتب | Bulletins de paie"],
            // Documents immobiliers
            ["name" => "عقد ملكية | Titre de propriété"],
            ["name" => "شهادة المسح | Certificat de cadastre"],
            ["name" => "رخصة البناء | Permis de construire"],
            ["name" => "عقد كراء | Contrat de location"],
            ["name" => "فاتورة الماء | Facture d'eau"],
            ["name" => "فاتورة الكهرباء | Facture d'électricité"],
            ["name" => "فاتورة الغاز | Facture de gaz"],
            // Documents commerciaux et d'entreprise
            ["name" => "العقد الأساسي | Statuts de la société"],
            ["name" => "قيد السجل التجاري | Registre de commerce"],
            ["name" => "محضر الجمعية العامة | Procès-verbal d'assemblée générale"],
            ["name" => "ميزانية | Bilan comptable"],
            ["name" => "قائمة الدخل | Compte de résultat"],
            ["name" => "دفتر الجرد | Livre d'inventaire"],
            // Documents bancaires
            ["name" => "RIB | Relevé d'identité bancaire"],
            ["name" => "كشف الحساب السنوي | Relevé de compte annuel"],
            ["name" => "مستندات القروض | Documents de prêt"],
            // Documents divers
            ["name" => "عقد شراكة | Contrat de partenariat"],
            ["name" => "رخصة النشاط | Licence d'exploitation"],
            ["name" => "شهادة مطابقة | Certificat de conformité"],
            ["name" => "فاتورة الهاتف | Facture de téléphone"],
            ["name" => "فاتورة الإنترنت | Facture d'internet"],
            ["name" => "مستندات الاستيراد/التصدير | Documents d'importation/exportation"],
            // Documents liés aux investissements
            ["name" => "شهادة الاستثمار | Certificat d'investissement"],
            ["name" => "اتفاقية المساهمة | Convention de participation"],
            ["name" => "مستندات توزيع الأرباح | Documents de distribution des dividendes"]
        ];

        foreach ($documents as $document) {
            DocumentName::create($document);
        }
    }
}