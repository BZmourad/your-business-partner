<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission\Permission;

class PermissionTableSeeder extends Seeder
{
    public function run(): void{
        Permission::create(['name' => "customers", 'description' => "Customers", "icon" => "icon-users"]);
        Permission::create(['name' => "partners", 'description' => "Partners", "icon" => "icon-user-following"]);
        Permission::create(['name' => "services", 'description' => "Services", "icon" => "la la-briefcase"]);
        Permission::create(['name' => "report", 'description' => "Report", "icon" => "la la-bar-chart"]);
        Permission::create(['name' => "timelines", 'description' => "Timelines", "icon" => "la la-clock-o"]);
        Permission::create(['name' => "configuration", 'description' => "Configuration", "icon" => "la la-cogs"]);
        Permission::create(['name' => "users", 'description' => "Users", "icon" => "la la-users"]);
        Permission::create(['name' => "contacts", 'description' => "Contacts", "icon" => "la la-wechat"]);
    }
}
