<?php

namespace Database\Seeders;

use App\Models\Partner\Partner;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PartnerSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('fr_FR');

        $partnerTypes = ['particulier', 'entreprise'];
        $genders = ['homme', 'femme'];
        $maritalStatuses = ['single', 'married', 'divorced', 'widowed'];
        $idTypes = ['cin', 'passport'];
        $taxRegimes = ['Régime réel normal', 'Régime simplifié', 'Micro-entreprise', 'Auto-entrepreneur'];
        $businessSectors = ['Informatique', 'Commerce', 'Santé', 'Construction', 'Services', 'Transport', 'Restaurant', 'Banque'];

        for ($i = 1; $i <= 10; $i++) {
            $partnerType = $faker->randomElement($partnerTypes);
            $isCompany = $partnerType === 'entreprise';

            $partner = Partner::create([
                'partner_type' => $partnerType,
                'last_name' => $faker->lastName,
                'first_name' => $faker->firstName,
                'email' => 'partner.'.$i.'@ybp.test',
                'gender' => $isCompany ? null : $faker->randomElement($genders),
                'birth_date' => $isCompany ? null : $faker->dateTimeBetween('-70 years', '-18 years')->format('Y-m-d'),
                'birth_place' => $isCompany ? null : $faker->city,
                'country' => 'TN',
                'nationality' => 'TN',
                'marital_status' => $isCompany ? null : $faker->randomElement($maritalStatuses),
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'fax' => $faker->boolean(20) ? $faker->phoneNumber : null,
                'id_type' => $isCompany ? null : $faker->randomElement($idTypes),
                'id_number' => $isCompany ? null : strtoupper($faker->bothify('??#########')),
                'id_issue_date' => $isCompany ? null : $faker->dateTimeBetween('-10 years', '-1 year')->format('Y-m-d'),
                'id_issue_place' => $isCompany ? null : $faker->city,
                'id_expiry_date' => $isCompany ? null : $faker->dateTimeBetween('+1 year', '+10 years')->format('Y-m-d'),
                'profession' => $isCompany ? null : $faker->jobTitle,
                'job_title' => $isCompany ? $faker->jobTitle : null,
                'employer' => $isCompany ? $faker->company : $faker->company,
                'work_address' => $faker->address,
                'work_phone' => $faker->phoneNumber,
                'activity' => $faker->catchPhrase,
                'tax_id' => strtoupper($faker->bothify('M??#########')),
                'tax_regime' => $faker->randomElement($taxRegimes),
                'commerce_register_number' => $isCompany ? strtoupper($faker->bothify('RC??????')) : null,
                'business_sector' => $isCompany ? $faker->randomElement($businessSectors) : null,
                'created_at' => $faker->dateTimeBetween('-60 days', '-31 days')
            ]);
            $partner->update(['reference'=>getRefrence($partner->id, "PR")]);
        }
    }
}