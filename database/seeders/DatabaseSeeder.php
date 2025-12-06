<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(DocumentSeeder::class);
        $this->call(ServiceFiscalTunisieSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(PartnerSeeder::class);
        //$this->call(RequestSeeder::class);
        $this->call(MessageSeeder::class);
    }
}
