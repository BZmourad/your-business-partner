<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Permission\Role;
use App\Models\Permission\Permission;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('fr_FR');

        $role = Role::create(['name' => 'Admin']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user = User::create([
            'first_name' => 'Mourad',
            'last_name' => 'Bouzidi',
            'name' => 'Mourad Bouzidi',
            'email' => 'admin@ybp.test',
            'email_verified_at' => now(),
            'type' => 'admin',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        $user->assignRole([$role->id]);

        for ($i=1; $i <= 5; $i++) { 
            $role = Role::create(['name' => 'role'.$i]);
            $allPermissions = Permission::all();
            $randomPermissions = $faker->randomElements(
                $allPermissions->pluck('id')->toArray(),
                $faker->numberBetween(5, ($allPermissions->count()-1))
            );
            $role->syncPermissions($randomPermissions);
            $k = rand(1,3);
            for ($j=1; $j <= $k; $j++) { 
                $firstName = $faker->firstName();
                $lastName = $faker->lastName();
                $user = User::create([
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'name' => $firstName . ' ' . $lastName,
                    'email' => 'user.'.$i.'.'.$j.'@ybp.test',
                    'email_verified_at' => now(),
                    'type' => 'admin',
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                ]);
                $user->assignRole([$role->id]);
            }
        }
    }
}
