<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = $this->faker->randomElement(['M', 'F']);
        $civilStatus = $this->faker->randomElement(['célibataire', 'marié', 'divorcé', 'veuf']);
        $idType = $this->faker->randomElement(['CIN', 'Passeport']);
        
        return [
            'type' => $this->faker->randomElement(['personne_physique', 'personne_morale']),
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName($gender == 'M' ? 'homme' : 'femme'),
            'sexe' => $gender,
            'date_naissance' => $this->faker->dateTimeBetween('-70 years', '-18 years')->format('Y-m-d'),
            'lieu_naissance' => $this->faker->city,
            'nationalite' => 'Française',
            'etat_civil' => $civilStatus,
            'adresse_complete' => $this->faker->address,
            'telephone' => $this->faker->numerify('06########'),
            'fax' => $this->faker->optional(0.3)->numerify('01########'),
            'whatsapp' => $this->faker->optional(0.7)->numerify('06########'),
            'type_piece_identite' => $idType,
            'numero_cin_passeport' => $this->faker->bothify('##' . strtoupper($this->faker->randomLetter . $this->faker->randomLetter) . '######'),
            'date_delivrance' => $this->faker->dateTimeBetween('-10 years', '-1 year')->format('Y-m-d'),
            'lieu_delivrance' => 'Préfecture de ' . $this->faker->address,
            'date_expiration' => $this->faker->dateTimeBetween('+1 year', '+9 years')->format('Y-m-d'),
            'profession' => $this->faker->jobTitle,
            'fonction' => $this->faker->jobTitle,
            'employeur' => $this->faker->company,
            'adresse_professionnelle' => $this->faker->address,
            'telephone_professionnel' => $this->faker->optional(0.8)->numerify('01########'),
            'activite' => $this->faker->bs,
            'matricule_fiscal' => $this->faker->optional(0.8)->bothify('FR###########'),
            'regime_fiscal' => $this->faker->randomElement(['Réel normal', 'Réel simplifié', 'Micro-entreprise']),
            'numero_registre_commerce' => $this->faker->optional(0.6)->bothify('#######'),
            'secteur_activite' => $this->faker->randomElement(['Technologie', 'Commerce', 'Services', 'Industrie', 'Santé', 'Éducation']),
            'banque' => $this->faker->randomElement(['BNP Paribas', 'Crédit Agricole', 'Société Générale', 'LCL', 'Banque Populaire', 'CIC']),
            'agence' => $this->faker->city . ' Centre',
            'rib' => $this->faker->optional(0.7)->iban('FR'),
            'created_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}