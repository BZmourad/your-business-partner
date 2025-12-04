<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service\Service;
use App\Models\Service\ServiceDocument;
use App\Models\Service\ServiceFormField;
use Faker\Factory as Faker;
use App\Models\Permission\Permission;

class ServiceFiscalTunisieSeeder extends Seeder
{
    public function run(): void{
        $faker = Faker::create('fr_FR');
        $services = [
            [
                'name' => 'Conseil fiscal aux entreprises',
                'description' => 'Service de conseil fiscal spécialisé pour les entreprises',
                'documents' => [
                    ['name' => 'Carte d\'identification fiscale', 'description' => 'Carte fiscale de l\'entreprise', 'is_required' => true],
                    ['name' => 'Matricule fiscal', 'description' => 'Numéro d\'identification fiscale', 'is_required' => true],
                    ['name' => 'Registre de commerce', 'description' => 'Extrait du registre de commerce', 'is_required' => true],
                    ['name' => 'Déclaration fiscale des entreprises', 'description' => 'Dernière déclaration fiscale', 'is_required' => true],
                    ['name' => 'Registres comptables', 'description' => 'Livres comptables de l\'exercice', 'is_required' => true],
                ]
            ],
            [
                'name' => 'Optimisation fiscale',
                'description' => 'Optimisation de la situation fiscale des entreprises',
                'documents' => [
                    ['name' => 'Bilan comptable', 'description' => 'Bilan des 3 derniers exercices', 'is_required' => true],
                    ['name' => 'Compte de résultat', 'description' => 'Comptes de résultats des 3 dernières années', 'is_required' => true],
                    ['name' => 'Contrats commerciaux', 'description' => 'Contrats en cours', 'is_required' => false],
                ]
            ],
            [
                'name' => 'Déclarations fiscales',
                'description' => 'Préparation et dépôt des déclarations fiscales',
                'documents' => [
                    ['name' => 'Relevés bancaires', 'description' => 'Relevés des 6 derniers mois', 'is_required' => true],
                    ['name' => 'Factures fournisseurs', 'description' => 'Factures de l\'exercice', 'is_required' => true],
                    ['name' => 'Factures clients', 'description' => 'Factures émises', 'is_required' => true],
                ]
            ],
            [
                'name' => 'Audit fiscal',
                'description' => 'Audit complet de la situation fiscale',
                'documents' => [
                    ['name' => 'Statuts de la société', 'description' => 'Statuts mis à jour', 'is_required' => true],
                    ['name' => 'Procès-verbaux d\'assemblée', 'description' => 'PV des dernières assemblées', 'is_required' => true],
                    ['name' => 'Contrats de travail', 'description' => 'Contrats des employés', 'is_required' => false],
                ]
            ],
            [
                'name' => 'Gestion de la TVA',
                'description' => 'Gestion et déclaration de la taxe sur la valeur ajoutée',
                'documents' => [
                    ['name' => 'Journal des achats', 'description' => 'Journal des achats avec TVA', 'is_required' => true],
                    ['name' => 'Journal des ventes', 'description' => 'Journal des ventes avec TVA', 'is_required' => true],
                    ['name' => 'Reçus de TVA', 'description' => 'Reçus des déclarations précédentes', 'is_required' => true],
                ]
            ],
            [
                'name' => 'Contentieux fiscal',
                'description' => 'Assistance en matière de contentieux fiscal',
                'documents' => [
                    ['name' => 'Notifications fiscales', 'description' => 'Notifications reçues', 'is_required' => true],
                    ['name' => 'Courriers échangés', 'description' => 'Correspondance avec l\'administration', 'is_required' => true],
                    ['name' => 'Procès-verbaux de contrôle', 'description' => 'PV de contrôle fiscal', 'is_required' => true],
                ]
            ],
            [
                'name' => 'Fiscalité immobilière',
                'description' => 'Conseil en fiscalité immobilière',
                'documents' => [
                    ['name' => 'Titre de propriété', 'description' => 'Titre foncier', 'is_required' => true],
                    ['name' => 'Contrat de vente', 'description' => 'Contrat d\'acquisition', 'is_required' => true],
                    ['name' => 'Taxe foncière', 'description' => 'Avis d\'imposition foncière', 'is_required' => true],
                ]
            ],
            [
                'name' => 'Fiscalité personnelle',
                'description' => 'Conseil en fiscalité pour les particuliers',
                'documents' => [
                    ['name' => 'CIN', 'description' => 'CIN du contribuable', 'is_required' => true],
                    ['name' => 'Bulletins de salaire', 'description' => 'Bulletins des 12 derniers mois', 'is_required' => true],
                    ['name' => 'Relevés de compte', 'description' => 'Relevés bancaires personnels', 'is_required' => false],
                ]
            ],
            [
                'name' => 'Création d\'entreprise',
                'description' => 'Assistance à la création d\'entreprise',
                'documents' => [
                    ['name' => 'Projet d\'entreprise', 'description' => 'Business plan', 'is_required' => true],
                    ['name' => 'Pièce d\'identité du promoteur', 'description' => 'CIN du fondateur', 'is_required' => true],
                    ['name' => 'Justificatif de domicile', 'description' => 'Facture utilities', 'is_required' => true],
                ]
            ]
        ];
        foreach ($services as $serviceData) {
            $service = Service::create([
                'name' => $serviceData['name'],
                'slug' => createUniqueSlug($serviceData['name'], Service::class),
                'description' => $serviceData['description'],
                'created_at' => $faker->dateTimeBetween('-80 days', '-61 days')
            ]);
            $service->update(['reference'=>getRefrence($service->id, "SV")]);
            Permission::create(['name' => $service->slug, 'service_id' => $service->id, 'description' => $service->name]);
            $this->createDocuments($service, $serviceData['documents']);
            $this->addCommonFormFields($service);
        }
    }

    private function createDocuments(Service $service, array $documents): void{
        foreach ($documents as $documentData) {
            ServiceDocument::create([
                'service_id' => $service->id,
                'name' => $documentData['name'],
                'description' => $documentData['description'],
                'is_required' => $documentData['is_required'],
            ]);
        }
    }

    private function addCommonFormFields(Service $service): void{
        $formFields = [
            [
                'name' => 'Secteur d\'activité',
                'type' => 'single_select',
                'options' => 'Commerce,Industrie,Services,Immobilier,Tourisme',
                'is_required' => true
            ],
            [
                'name' => 'Description du besoin',
                'type' => 'long_text',
                'options' => null,
                'is_required' => true
            ],
            [
                'name' => 'Chiffre d\'affaires annuel',
                'type' => 'number',
                'options' => null,
                'is_required' => false
            ],
            [
                'name' => 'Date de début d\'activité',
                'type' => 'date',
                'options' => null,
                'is_required' => false
            ]
        ];
        foreach ($formFields as $fieldData) {
            ServiceFormField::create([
                'service_id' => $service->id,
                'name' => $fieldData['name'],
                'type' => $fieldData['type'],
                'options' => $fieldData['options'],
                'is_required' => $fieldData['is_required']
            ]);
        }
    }
}